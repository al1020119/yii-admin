/**
 * Database schema required by \yii\rbac\DbManager.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 2.0
 */

drop table "assignment";
drop table "item_child";
drop table "auth_item";
drop table "auth_rule";

-- create new auth_rule table
create table "auth_rule"
(
   "name"  varchar(64) not null,
   "data"  varchar(1000),
   "created_at"           integer,
   "updated_at"           integer,
    primary key ("name")
);

-- create auth_item table
create table "auth_item"
(
   "name"                 varchar(64) not null,
   "type"                 integer not null,
   "description"          varchar(1000),
   "rule_name"            varchar(64),
   "data"                 varchar(1000),
   "created_at"           integer,
   "updated_at"           integer,
        foreign key ("rule_name") references "auth_rule"("name") on delete set null,
        primary key ("name")
);
-- adds oracle specific index to auth_item 
CREATE INDEX auth_type_index ON "auth_item"("type");

create table "item_child"
(
   "parent"               varchar(64) not null,
   "child"                varchar(64) not null,
   primary key ("parent","child"),
   foreign key ("parent") references "auth_item"("name") on delete cascade,
   foreign key ("child") references "auth_item"("name") on delete cascade
);

create table "assignment"
(
   "item_name"            varchar(64) not null,
   "user_id"              varchar(64) not null,
   "created_at"           integer,
   primary key ("item_name","user_id"),
   foreign key ("item_name") references "auth_item" ("name") on delete cascade
);
