<?php
include_once 'header.php'
?>
<header class="mb-auto">
  <div>
    <h3 class="float-md-start mb-0">預約系統</h3>
    <nav class="nav nav-masthead justify-content-center float-md-end">
      <a class="nav-link" href="index.php">主頁</a>
      <a class='nav-link active' href='#'>新活動</a>
      <a class='nav-link' href='include/logout.inc.php'>登出</a>
    </nav>
  </div>
</header>
<main class="px-3">
  <div class="container">
    <?php
        if (isset($_GET["error"])) {
    if ($_GET["error"] == "stmtfailed") {
      echo "<p>請重試一次</p>";
    }else if ($_GET["error"] == "orderExisted") {
      echo "<p>已報名過</p>";
    }else if ($_GET["error"] == "none") {
      echo "<p>報名成功</p>";
    }
  }
  ?>
    <div class="row row-cols-5 border rounded">
      <div class="col pt-1"><h5>活動名稱</h5></div>
      <div class="col pt-1"><h5>日期</h5></div>
      <div class="col pt-1"><h5>地點</h5></div>
      <div class="col pt-1"><h5>名額</h5></div>
      <div class="col pt-1"><h5></h5></div>
    </div>
      
       <?php
    $activity;
    require_once 'include/database.inc.php';
    require_once 'include/activity_function.inc.php';
    $activity = getActivity($conn);
    foreach ($activity as $row) {
      echo '<div class="row row-cols-5 border rounded">';
      echo '<div class="col pt-3"><h4>'.$row['name'].'</h4></div>';
      echo '<div class="col pt-3"><p>'.$row['time'].'</p></div>';
      echo '<div class="col pt-3"><p>'.$row['place'].'</p></div>';
      echo '<div class="col pt-3"><p>'.$row['capacity'].'</p></div>';
      echo '<form action="include/activity.inc.php" method="post"><div class="col pt-3"><input type="hidden" value="'.$row['id'].'" name="input2"/><button class="btn btn-lg btn-light" type="submit" name="submit">報名</button></div></form>';
      echo '</div>';
    }
  ?>
  </div>
</main>
<?php
include_once 'footer.php'
?>
