<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<table>
    <tr>
        <th>1</th>
        <th id="th1" onclick="SortTable(this)" class="as">2</th>
        <th id="th2" onclick="SortTable(this)" class="as">3</th>
        <th id="th3" onclick="SortTable(this)" class="as">4</th>
    </tr>
    <tr>
        <td name="td0">1111</td>
        <td name="td1">17</td>
        <td name="td2">24</td>
        <td name="td3">13</td>
    </tr>
    <tr>
        <td name="td0">2222</td>
        <td name="td1">15</td>
        <td name="td2">22</td>
        <td name="td3">16</td>
    </tr>
    <tr>
        <td name="td0">3333</td>
        <td name="td1">19</td>
        <td name="td2">15</td>
        <td name="td3">20</td>
    </tr>
    <tr>
        <td name="td0">4444</td>
        <td name="td1">23</td>
        <td name="td2">15</td>
        <td name="td3">14</td>
    </tr>
</table>
</body>
</html>
<script type="text/javascript">
    var tag=1;
    function sortNumberAS(a, b)
    {
        return a - b
    }
    function sortNumberDesc(a, b)
    {
        return b-a
    }

    function SortTable(obj){
        var td0s=document.getElementsByName("td0");
        var td1s=document.getElementsByName("td1");
        var td2s=document.getElementsByName("td2");
        var td3s=document.getElementsByName("td3");
        var tdArray0=[];
        var tdArray1=[];
        var tdArray2=[];
        var tdArray3=[];
        for(var i=0;i<td0s.length;i++){
            tdArray0.push(td0s[i].innerHTML);
        }
        for(var i=0;i<td1s.length;i++){
            tdArray1.push(parseInt(td1s[i].innerHTML));
        }
        for(var i=0;i<td2s.length;i++){
            tdArray2.push(parseInt(td2s[i].innerHTML));
        }
        for(var i=0;i<td3s.length;i++){
            tdArray3.push(parseInt(td3s[i].innerHTML));
        }
        var tds=document.getElementsByName("td"+obj.id.substr(2,1));
        var columnArray=[];
        for(var i=0;i<tds.length;i++){
            columnArray.push(parseInt(tds[i].innerHTML));
        }
        var orginArray=[];
        for(var i=0;i<columnArray.length;i++){
            orginArray.push(columnArray[i]);
        }
        if(obj.className=="as"){
            columnArray.sort(sortNumberAS);               //排序后的新值
            obj.className="desc";
        }else{
            columnArray.sort(sortNumberDesc);               //排序后的新值
            obj.className="as";
        }


        for(var i=0;i<columnArray.length;i++){
            for(var j=0;j<orginArray.length;j++){
                if(orginArray[j]==columnArray[i]){
                    document.getElementsByName("td0")[i].innerHTML=tdArray0[j];
                    document.getElementsByName("td1")[i].innerHTML=tdArray1[j];
                    document.getElementsByName("td2")[i].innerHTML=tdArray2[j];
                    document.getElementsByName("td3")[i].innerHTML=tdArray3[j];
                    orginArray[j]=null;
                    break;
                }
            }
        }
    }
</script>
