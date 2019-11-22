<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 
​
<?php
// 定义变量并设置为空值
$setNoErr = $subNoErr = $rNameErr = $rDateErr = "";
$setNo = $subNo = $rName = $bDate = "";
​
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	   if (empty($_POST["setNo"])) {
     $setNoErr = "盘号是必填的";
   } else {
     $setNo = test_input($_POST["setNo"]);
     }
	
	   if (empty($_POST["subNo"])) {
     $subNoErr = "盘位号是必填的";
   } else {
     $subNo = test_input($_POST["subNo"]);
     }

        	
	
   if (empty($_POST["rName"])) {
     $rNameErr = "借用人是必填的";
   } else {
     $rName = test_input($_POST["rName"]);
     }
   }

   if (empty($_POST["bDate"])) {
     $rDateErr = "日期是必填的";
   } else {
     $rDate = test_input($_POST["bDate"]);
     }
   }
      
}
​
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<h2>归还钥匙</h2>
<p><td class="error"></td></p>
<form method="post" action=returnkey.php>

<table>

<tr>
   <td>
   钥匙盘*：<input type="number" name="setNo">

 </td>
 <td>
   盘位号*：<input type="number" name="subNo">

  </td>
    <td>  
   房间名：<input type="text" name="keyName">

     </td>   
    <td>  
   借用人*：<input type="text" name="rName">

        </td>
    <td>
   归还日期*：<input type="date" name="bDate">

        </td>      
  <td>  
   确认人*：<input type="text" name="confirm">

</td>
<td>
   <input type="submit" name="submit" value="OK"> 
        </td>
</tr>
<table>
</form>
​
​
</body>
</html>