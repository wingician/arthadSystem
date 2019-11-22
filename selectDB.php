<?php
$servername = "localhost";
$username = "wordpress_user";
$password = "SHXY3dTech";
$dbname = "wordpress";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
}
$sql = "SELECT key_set_no,set_number_sub,key_name,key_total_quantity,comment,in_ymd FROM wp_jh_key";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            echo"钥匙盘号" . $row["key_set_no"]. "钥匙盘位号:" .$row["set_number_sub"] . "钥匙名字: " . $row["key_name"]. " - 注释: " . $row["comment"]. "钥匙把数" . $row["key_total_quantity"]. "<br>";
                        }
} else {
        echo "0 结果";
}
$conn->close();
?>
