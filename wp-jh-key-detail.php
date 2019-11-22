<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>钥匙盘号</th><th>盘位号</th><th>钥匙名字</th><th>总数</th><th>剩余钥匙数量</th><th>入库日期</th><th>注释</th></tr>";
 
class TableRows extends RecursiveIteratorIterator {
	    function __construct($it) { 
			        parent::__construct($it, self::LEAVES_ONLY); 
					    }
		 
		    function current() {
				        return "<td style='width:200px;border:1px solid grey;'>" . parent::current(). "</td>";
						    }
		 
		    function beginChildren() { 
				        echo "<tr>"; 
						    } 
		 
		    function endChildren() { 
				        echo "</tr>" . "\n";
						    } 
} 
 
$servername = "localhost";
$username = "wordpress_user";
$password = "SHXY3dTech";
$dbname = "wordpress";
 
try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $stmt = $conn->prepare("SELECT key_set_no, set_number_sub, key_name,key_total_quantity,key_quantity_last,in_ymd,comment FROM wp_jh_key"); 
			    $stmt->execute();
			 

			    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
				    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
						        echo $v;
								    }
}
catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>

