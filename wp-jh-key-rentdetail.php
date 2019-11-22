
<?php
/*
  Template Name:钥匙明细
*/

?>

<?php
get_header();
get_template_part('index','banner'); ?>
<!-- Blog Section with Sidebar -->
<div class="page-builder">
	<div class="container">
		<div class="row">
			<!-- Blog Area -->


<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>钥匙盘号</th><th>盘位号</th><th>钥匙名字</th><th>借用人</th><th>借用日期</th><th>归还日期</th></tr>";
 
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
$fname  = $_POST["fname"];
try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $stmt = $conn->prepare("select m.key_set_no,m.set_number_sub,c.key_name,m.rent_person,m.rent_date,m.return_date from wp_jh_key_rent m
left join wp_jh_key c on c.key_set_no = m.key_set_no and c.set_number_sub = m.set_number_sub
where m.rent_person = '".$fname."' "); 
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





			<!-- /Blog Area -->			
			<!--Sidebar Area-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<!--Sidebar Area-->
		</div>
	</div>
</div>
<!-- /Blog Section with Sidebar -->
<?php get_footer(); ?>


