<?php
    include_once 'header.php'
    ?>
    <header class="mb-auto">
      <div>
        <h3 class="float-md-start mb-0">預約系統</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link" href="index.php">主頁</a>
          <a class='nav-link' href='login.php'>登入</a>
          <a class='nav-link active' href='signup.php'>註冊</a>
        </nav>
      </div>
    </header>
	<main class="form-signin">
  		<form action="include/signup.inc.php" method="post">
    		<h1 class="h3 mb-3 fw-normal">請註冊</h1>

        <div class="form-floating  text-dark">
            <input type="text" name="name" class="form-control" id="start" placeholder="Username">
            <label for="floatingInput">使用者姓名</label>
        </div>
        <div class="form-floating  text-dark">
            <input type="text" name="account" class="form-control" placeholder="Account">
            <label for="floatingInput">使用者帳號</label>
        </div>
    		<div class="form-floating  text-dark">
      			<input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      			<label for="floatingInput">信箱</label>
    		</div>
    		<div class="form-floating  text-dark">
      			<input type="password" name="pwd" class="form-control" id="floatingInput" placeholder="Password">
      			<label for="floatingInput">密碼</label>
    		</div>
        <div class="form-floating  text-dark">
            <input type="password" name="pwdrepeat" class="form-control" id="end" placeholder="Repeat Password">
            <label for="floatingInput">密碼確認</label>
        </div>
    		<button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign up</button>

        <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
              echo "<p>請填入資料</p>";
            }else if ($_GET["error"] == "invalidAccount") {
              echo "<p>帳號只能有英文跟數字</p>";
            }else if ($_GET["error"] == "invalidEmail") {
              echo "<p>請使用正確的信箱</p>";
            }else if ($_GET["error"] == "pwdNotMatch") {
              echo "<p>密碼驗證錯誤</p>";
            }else if ($_GET["error"] == "accountExists") {
              echo "<p>帳號已存在</p>";
            }else if ($_GET["error"] == "stmtfailed") {
              echo "<p>請重試</p>";
            }else if ($_GET["error"] == "none") {
              echo "<p>註冊成功</p>";
            }
          }
        ?>
  		</form>
	</main>

  <?php
   include_once 'footer.php'
   ?>