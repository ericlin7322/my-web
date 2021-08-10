<?php
	echo "<h4 class='lead'>".$_SESSION["userName"]." 您好，這是您報名的場次。</p>";
?>
	<div class="container">
	<?php
        if (isset($_GET["error"])) {
    if ($_GET["error"] == "stmtfailed") {
      echo "<p>請重試一次</p>";
    }else if ($_GET["error"] == "none") {
      echo "<p>取消成功</p>";
    }
  }
  ?>
    <div class="row row-cols-4 border rounded">
      <div class="col pt-1"><h5>活動名稱</h5></div>
      <div class="col pt-1"><h5>日期</h5></div>
      <div class="col pt-1"><h5>地點</h5></div>
      <div class="col pt-1"><h5>名額</h5></div>
    </div>
      
<?php
    $activity;
    $userId = $_SESSION['userid'];
    require_once 'include/database.inc.php';
    require_once 'include/activity_function.inc.php';
    $activity = getUserOrder($conn, $userId);
    foreach ($activity as $row) {
    	foreach ($row as $key) {
    		echo '<div class="row row-cols-5 border rounded">';
      		echo '<div class="col pt-3"><h4>'.$key['name'].'</h4></div>';
      		echo '<div class="col pt-3"><p>'.$key['time'].'</p></div>';
      		echo '<div class="col pt-3"><p>'.$key['place'].'</p></div>';
      		echo '<div class="col pt-3"><p>'.$key['capacity'].'</p></div>';
      		echo '<form action="include/delete_order.inc.php" method="post"><div class="col pt-3"><input type="hidden" value="'.$key['id'].'" name="input2"/><button class="btn btn-lg btn-light" type="submit" name="submit">取消報名</button></div></form>';
      		echo '</div>';
    	}
    }
 ?>
  </div>
