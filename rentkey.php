<?php
echo "<html>" .  " <head> " . "</head>" ;
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
$rDate  = $_POST["rDate"];
$maxNo = 0;
$keyname = "";
$key_quantity_last = 0;
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
}


//获取最大编号数字
$sqlmaxNo = "select MAX(no) from wp_jh_key_rent";
$result =  $conn->query($sqlmaxNo) ;
while($row = mysqli_fetch_array($result))
{
    $maxNoArray =  $row['MAX(no)'];

    
}
$maxNo = $maxNoArray + 1;

//获取房间名称，钥匙剩余数量
$sqlkName = "select key_name,key_quantity_last from wp_jh_key where key_set_no='".$setNo."' and set_number_sub = '".$subNo."'";
$result =  $conn->query($sqlkName) ;
while($row = mysqli_fetch_array($result))
{
    $keyname =  $row['key_name'];
		$key_quantity_last =  $row['key_quantity_last'];
}

if ($key_quantity_last <= "0"){
	echo "<br>";
	echo "钥匙已经全部借出，请查看记录";
	echo "<br>";
	}
else{	
     //增加借钥匙数据记录
     $sql = "INSERT INTO wp_jh_key_rent (no, key_set_no, set_number_sub,key_name,rent_person,rent_date)
     VALUES ('".$maxNo."','".$setNo."','".$subNo."','".$keyname."','".$rName."','".$rDate."')";
     if (mysqli_query($conn, $sql)) {
         echo "借钥匙新记录插入成功！";
         echo "<br>";
         echo "<table border=1><tr bgcolor = #e34227>";
         echo "<td >盘号</td><td>盘位号</td><td>钥匙房间名</td><td>借用人</td><td>借用日期</td></tr>";
         echo "<tr><td>" . $setNo ."</td><td>" .$subNo. "</td><td>".$keyname."</td><td>" .$rName. "</td><td>".$rDate. "</td></tr></table>";
     } else {
         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
     //更新钥匙明细剩余
     $key_quantity_last = $key_quantity_last - 1;
     $sqlupd = "update wp_jh_key set  key_quantity_last = '".$key_quantity_last. "' where key_set_no='".$setNo."' and set_number_sub = '".$subNo."'";
     if (mysqli_query($conn, $sqlupd)) {
         echo "<br>";
     } else {
         echo "Error: " . $sqlupd . "<br>" . mysqli_error($conn);
     }
     
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

echo "</html>";
?>
