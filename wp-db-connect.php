   <?php
   
 define("DB_HOST","localhost");
   
 define("DB_USER","root");
   
 define("DB_PWD","root");
   
 define("DB_NAME","wordpress");
   
 $conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD) or die("连接服务器出错：".mysql_error());
   
 @mysql_select_db(DB_NAME) or die("连接数据库出错：".mysql_error());
   
 @mysql_query('SET NAMES UTF8');
   
 $strsql = "select * from tab;"

 $result = mysql_query($strsql);
 ?>



