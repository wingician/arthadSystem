<?php
echo "<html>" .  " <head> " . "钥匙归还结果：" . "</head>" ;
echo "<body> ";
echo "<br> ";

$servername = "localhost";
$username = "wordpress_user";
$password = "SHXY3dTech";
$dbname = "wordpress";
$setNo  = $_POST["setNo"];
$subNo  = $_POST["subNo"];
$keyName  = $_POST["keyName"];
$rName  = $_POST["rName"];
$bDate  = $_POST["bDate"];
$confirm  = $_POST["confirm"];
$key_quantity_last = 0;
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
}


//更新借钥匙记录
$sqlKback = "update  wp_jh_key_rent set return_date = '".$bDate. "', confirm = '".$confirm. "' where key_set_no='".$setNo."' and set_number_sub = '".$subNo."' and rent_person = '".$rName."' and return_date IS NULL ";
$result =  $conn->query($sqlKback) ;
if( $result === TRUE )
{
     echo "钥匙归还成功";
              echo "<table border=1><tr bgcolor = #e34227>";
         echo "<td >盘号</td><td>盘位号</td><td>钥匙房间名</td><td>借用人</td><td>归还日期</td><td>确认人</td></tr>";
         echo "<tr><td>" . $setNo ."</td><td>" .$subNo. "</td><td>".$keyname."</td><td>" .$rName. "</td><td>".$bDate. "</td><td>".$confirm. "</td></tr></table>";
              
     //更新钥匙明细剩余
     $sqlupd = "update wp_jh_key set  key_quantity_last = key_quantity_last + 1 where key_set_no='".$setNo."' and set_number_sub = '".$subNo."'";
     if (mysqli_query($conn, $sqlupd)) {
         echo "<br>";
     } else {
         echo "Error: " . $sqlupd . "<br>" . mysqli_error($conn);
     }    
}
else
{ 
mysql_error();
         echo "未找到相应的钥匙借出记录";
} 




$conn->close();

//画面迁移按钮
echo "<br>";
echo "<table> <tr>";
echo "<td><a href=http://192.168.1.254/wordpress/?page_id=125><button>查看全钥匙明细</button></a></td>";
echo "<td><a href=http://192.168.1.254/wordpress/?page_id=135><button>继续借钥匙</button></a></td>";
echo "<td><a href=http://192.168.1.254/wordpress/?page_id=159><button>归还钥匙</button></a></td>";
echo "<td><a href=http://192.168.1.254/wordpress/?page_id=129><button>查看借钥匙明细</button></a></td>";
echo "</tr></table>";
echo "</body>";


echo "</body>";

echo "</html>";
?>