<?php

//debug
ini_set('display_errors', 'on');

include_once("head.php");
include_once("menu.php");
include_once("inc/db.php");
echo '<div class="container">';
if (isset($_GET["user"])){

if ($stmt2 = $mysqli->prepare("SELECT bal, got_once FROM users WHERE uuid = ?")) { 
      $stmt2->bind_param('s', $_GET["user"]); 
      $stmt2->execute(); 
      $stmt2->store_result();
      $stmt2->bind_result($bal, $got_once);
      $stmt2->fetch();
      }

if (!$got_once == "true"){
if ($bal == 0){
$money = "100";
$yess = "true";
	if ($insert_stmt = $mysqli->prepare("UPDATE users SET bal = (?), got_once = (?) WHERE uuid = (?) LIMIT 1")) {    
	$insert_stmt->bind_param('sss', $money, $yess, $_GET["user"]); 
	$insert_stmt->execute();
	}
echo '<div class="alert alert-success">Success! your MCGE balance has now 100 M$</div>';
}else{
echo '<div class="alert alert-danger">Hey! you have some M$ to test with, you dont need more :P</div>';
}
}else{
echo '<div class="alert alert-danger">Hey! you already got your testing M$</div>';
}


}

?>








<div class="row">
        <div class="col-sm-7">
            <div class="well" style="min-height:220px;">
                    <h2>Global Economy system  for bukkit</h2>
                    <p style="text-align: justify;">MCGE is an Global Economy system for minecraft servers. The aim for this plugin is to get an Global money/economy system so you can have the same wallet on one server as you have on all MCGE servers. This plugin will bring servers together, and make Minecraft servers more fun and real.
                    </p>
                    
            </div>
        </div>
        <div class="col-sm-5">
<div class="panel panel-default">
  <div class="panel-heading">News</div>
  <div class="panel-body">
<h2>We are soon Ready</h2><p>We are soon ready to publish an test/beta version to bukkit dev.</p>
  </div>
</div>
        </div>
    </div>

      <div class="row">
        <div class="col-md-4">
          <h2>How to prevent cheat (Q/A)</h2>
<i>what is an server owner give himself "money" to his wallet, and then go to another server with this plugin and spend the money?</i><p /> Nobody can give money, they need to send a request for an x amount of money to there own server. (or a every player gets x amount of coins)<br /><p />
<i>
What is somebody edit the java code?</i><p /> They are welcome to do, but the accounts is stored on webservers


        </div>
        <div class="col-md-4">
          <h2>Why</h2>
<p>The goal of this is to make minecraft more "real".</p>
       </div>
        <div class="col-md-4">
          <h2>Install</h2>
          <p>Download the plugin at bukkit dev (comming soon)</p>
          <p>Copy mcge.jar into /plugins folder</p>
          <p>Reload the server</p>
        </div>
</div>
              
<?php include_once("foot.php"); ?>

</body>
</html>
