
<?php
include_once 'header.php'
?>
<header class="mb-auto">
  <div>
    <h3 class="float-md-start mb-0">預約系統</h3>
    <nav class="nav nav-masthead justify-content-center float-md-end">
      <a class="nav-link active" href="index.php">主頁</a>
      <?php
      if (isset($_SESSION["userid"])) {
        echo "<a class='nav-link' href='activity.php'>新活動</a>";
        echo "<a class='nav-link' href='include/logout.inc.php'>登出</a>";
      }else {
        echo "<a class='nav-link' href='login.php'>登入</a>";
        echo "<a class='nav-link' href='signup.php'>註冊</a>";
      }
      ?>

    </nav>
  </div>
</header>
<main class="px-3">
  <?php
  if (isset($_SESSION["userName"])) {
      include_once 'userOrder.php';
  }else {
    echo "<p class='lead'>歡迎來到預約系統，請先登入或是註冊。</p>";
  }
  ?>
  
  <p class="lead">
  </p>
</main>
<?php
include_once 'footer.php'
?>
