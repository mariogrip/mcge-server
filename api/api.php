<?php
// Server Version
require_once '../inc/db.php';

if (isset($_GET["cmd"])){
$cmd = $_GET["cmd"];

if ($cmd == "getBalance"){
if (isset($_GET["user"])){

if ($stmt2 = $mysqli->prepare("SELECT bal FROM users WHERE uuid = ?")) { 
      $stmt2->bind_param('s', $_GET["user"]); 
      $stmt2->execute(); 
      $stmt2->store_result();
      $stmt2->fetch();
      $num = $stmt2->num_rows;
      }
 if ($num > 0){

if ($stmt2 = $mysqli->prepare("SELECT bal FROM users WHERE uuid = ?")) { 
      $stmt2->bind_param('s', $_GET["user"]); 
      $stmt2->execute(); 
      $stmt2->store_result();
      $stmt2->bind_result($bal);
      $stmt2->fetch();
      }

echo $bal;
}else{
$ikkka = "0";
	if ($insert_stmt = $mysqli->prepare("INSERT INTO users (uuid, bal) VALUES (?, ?)")) {    
	$insert_stmt->bind_param('ss', $_GET["user"], $ikkka); 
	$insert_stmt->execute();
}
echo "0";
}
}else{
echo "false";
}
}

if ($cmd == "sendCoins"){
if (isset($_GET["user"]) && isset($_GET["pass"]) && isset($_GET["toUser"]) && isset($_GET["Amount"])){

if ($stmt2 = $mysqli->prepare("SELECT bal FROM users WHERE uuid = ?")) { 
      $stmt2->bind_param('s', $_GET["user"]); 
      $stmt2->execute(); 
      $stmt2->store_result();
      $stmt2->bind_result($balFrom);
      $stmt2->fetch();
      }
if ($stmt2 = $mysqli->prepare("SELECT bal FROM users WHERE uuid = ?")) { 
      $stmt2->bind_param('s', $_GET["toUser"]); 
      $stmt2->execute(); 
      $stmt2->store_result();
      $stmt2->bind_result($balTo);
      $stmt2->fetch();
      }	
if ($balFrom >= $_GET["Amount"]){
$balFrom = $balFrom - $_GET["Amount"];
$balTo = $balTo + $_GET["Amount"];
        if ($insert_stmt = $mysqli->prepare("UPDATE user SET bal = (?) WHERE uuid = (?) LIMIT 1")) {    
	$insert_stmt->bind_param('ss', $balFrom, $_GET["user"]); 
	$insert_stmt->execute();
	}

	if ($insert_stmt = $mysqli->prepare("UPDATE user SET bal = (?) WHERE uuid = (?) LIMIT 1")) {    
	$insert_stmt->bind_param('ss', $balTo, $_GET["toUser"]); 
	$insert_stmt->execute();
	}
echo "true";
}else{echo "x1";}


}else{
echo "false";
}
}

if ($cmd == "getTop"){
echo "getTop";
}
if ($cmd == "checkCon"){
echo "true";
}
if ($cmd == "checkPass"){
echo "true";
}
}
?>
