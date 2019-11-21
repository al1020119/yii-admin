<?php

namespace common\monitors;

use yii\db\mssql\PDO;

/**
 * 功能：连接数据库，读取表结构，根据定义的模板输出字符串
 *
 * @Author iCocos <icocos.cao@wetax.com.cn>
 */

class MySQLStructMonitor {
    private $dbName;
    private $db;

    /**
     * 构造函数
     *
     * 连接数据库
     *
     * @param string $host         数据库地址，包含端口。例：127.0.0.1:3306
     * @param string $dbName       数据库名字
     * @param string $user         数据库用户名
     * @param string $password     数据库密码
     */
    public function __construct ($host, $dbName, $user, $password = '')
    {
        $dsn = sprintf("mysql:host=%s;dbname=%s", $host, $dbName);

        try {
            $this->db = new PDO($dsn, $user, $password);
            $this->db->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo '连接失败：' . $e->getMessage();
        }

        $this->dbName = $dbName;
    }

    /**
     * 获取数据库中所有表名和表注释
     *
     * @return array $tables       所有表名和表注释的二维数组
     */
    private function getTables ()
    {
        $query = $this->db->prepare('SELECT table_name, table_comment FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = :dbName');
        $query->bindParam(':dbName', $this->dbName, PDO::PARAM_STR);
        $query->execute();

        $tables = $query->fetchAll(PDO::FETCH_ASSOC);

        return $tables;
    }

    /**
     * 获取指定表的所有字段信息
     *
     * @param string $tableName    指定表名
     *
     * @return array $columns      返回指定表所有字段的数组
     *
     * 查询结果的列名
     * Field                       字段名称
     * Type                        字段类型
     * Collation                   字符集
     * Null                        是否为可空：YES or NO
     * Key                         索引类型：PRI = 主键，UNI = 唯一索引，MUL = 普通索引
     * Default                     默认值
     * Extra                       扩展信息，自增：AUTO_INCREMENT
     * Privileges                  权限
     * Comment                     注释
     */
    private function getColumns ($tableName)
    {
        $query = $this->db->prepare('SHOW FULL COLUMNS FROM ' . $tableName);
        $query->execute();

        $columns = $query->fetchAll(PDO::FETCH_ASSOC);

        return $columns;
    }

    /**
     * 在实例化后直接指定此方法就能直接输出
     *
     * @param array $templates     表模板和字段模板
     *
     * @return string $string      返回字符串
     */
    public function run ($template_column = null)
    {
        $tables = $this->getTables();

        $structsArray = [];
        foreach ($tables as $table) {
            $table_structs = [];
            //获取表名
            $tableName = $table['table_name'];
            $table_structs['tableName'] = $tableName;

            //获取表评论
            $tableComments = explode("\r\n", $table['table_comment']);
            $tableComment = $tableComments[0] ?: $tableName;
            $table_structs['tableComment'] = $tableComment;

            $columns = $this->getColumns($table['table_name']);
            $columnArray = [];
            if (!empty($template_column)) {
                foreach ($columns as $column) {
                    $columnString = $this->replaceTemplate($column, $template_column);
                    array_push($columnArray,$columnString);
                }
            } else {
                $columnArray = $columns;
            }
            $table_structs['columns'] = $columnArray;
            $structsArray[] = $table_structs;
        }

        return $structsArray;
    }

    /**
     * 根据字段模板替换
     *
     * @param array $column        字段数组
     * @param string $template     字段模板
     *
     * @return string $string      返回替换后字符串
     *
     * 'Field' => string 'id' (length=2)
     * 'Type' => string 'int(11)' (length=7)
     * 'Collation' => null
     * 'Null' => string 'NO' (length=2)
     * 'Key' => string 'PRI' (length=3)
     * 'Default' => null
     * 'Extra' => string 'auto_increment' (length=14)
     * 'Privileges' => string 'select,insert,update,references' (length=31)
     * 'Comment' => string '用户唯一标识' (length=18)
     */
    private function replaceTemplate ($column, $template)
    {
        $search = [
            '{field}',
            '{type}',
            '{collation}',
            '{null}',
            '{key}',
            '{default}',
            '{extra}',
            '{privileges}',
            '{comment}',
            '{nullName}',
            '{keyName}',
        ];

        $replace = [
            $column['Field'] ?: ' ',
            $column['Type'] ?: ' ',
            $column['Collation'] ?: ' ',
            $column['Null'] ?: ' ',
            $column['Key'] ?: ' ',
            $column['Default'] ?: ' ',
            $column['Extra'] ?: ' ',
            $column['Privileges'] ?: ' ',
            $column['Comment'] ?: ' ',
            $this->getNullName($column['Null']) ?: ' ',
            $this->getKeyName($column['Key']) ?: ' ',
        ];

        $string = str_replace($search, $replace, $template);
        $string = preg_replace('/\s+/', ' ', $string);
        return $string;
    }

    /**
     * 字段参数转换
     *
     * @param string $key          key 参数，PRI, UNI, MUL
     *
     * @return string $keyName     返回对应的参数名称
     */
    private function getKeyName($key)
    {
        switch ($key) {
            case 'PRI':
                $keyName = 'Primary Key';
                break;

            case 'UNI':
                $keyName = 'Unique Key';
                break;

            case 'MUL':
                $keyName = 'Key';
                break;

            default:
                $keyName = $key;
        }

        return $keyName;
    }

    /**
     * 字段参数转换
     *
     * @param string $null         null 参数，YES or NO
     *
     * @return string              返回空字符串或 NOT NULL
     */
    private function getNullName ($null)
    {
        if ($null == 'YES') {
            return '';
        } else {
            return 'NOT NULL';
        }
    }
}
