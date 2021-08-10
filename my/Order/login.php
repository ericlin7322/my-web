<?php
include_once 'header.php'
?>
<header class="mb-auto">
  <div>
    <h3 class="float-md-start mb-0">預約系統</h3>
    <nav class="nav nav-masthead justify-content-center float-md-end">
      <a class="nav-link" href="index.php">主頁</a>
      <a class='nav-link active' href='login.php'>登入</a>
      <a class='nav-link' href='signup.php'>註冊</a>
    </nav>
  </div>
</header>
<main class="form-signin px-3">
  <form action="include/login.inc.php" method="post">
    <h1 class="h3 mb-3 fw-normal">請登入</h1>

    <div class="form-floating text-dark">
     <input type="text" name="account" class="form-control" id="start" placeholder="Account">
     <label for="floatingInput">使用者帳號</label>
   </div>
   <div class="form-floating text-dark">
     <input type="password" name="pwd" class="form-control" id="end" placeholder="Password">
     <label for="floatingPassword">密碼</label>
   </div>
   <button class="w-100 btn btn-lg btn-primary" name="submit" type="submit">登入</button>
   <?php
   if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
      echo "<p>請填入資料</p>";
    }else if ($_GET["error"] == "wronglogin") {
      echo "<p>帳號錯誤</p>";
    }else if ($_GET["error"] == "pwdWrong") {
      echo "<p>密碼錯誤</p>";
    }
  }
  ?>
</form>
</main>
<?php
include_once 'footer.php'
?>