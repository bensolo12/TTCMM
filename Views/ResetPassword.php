<!DOCTYPE html>
<html>

<style>
  body {
    background-color: #f1f1f1;
  }

  form {
    background-color: #fff;
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
  }

  h1 {
    text-align: center;
  }

  p {
    text-align: center;
  }

  input[type=email], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type=submit] {
    background-color: #8403fc;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
  }

  input[type=submit]:hover {
    background-color: #6602a2;
  }

  a {
    display: block;
    text-align: center;
  }

  #footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 5rem;
  }
  
  .nav {
    display: flex;
    justify-content: space-between;
  }

  .nav li:nth-child(5) {
    margin-left: auto;
  }

  .nav li {
    display: flex;
    align-items: center;
  }
</style>

<head>
<title>Password Reset</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/style.CSS">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <nav id="navbar">
  <!-- space and framework left to make navbar collapsable if needed -->
      <div class="">
        <ul id="NavList"class="nav">
          <li id="NavHome"><a class="NavActive" href="Index.html">Home</a></li>
          <li id="NavReport"><a href="ReportPage.php">Report Issue</a></li>
          <li id="NavView"><a href="view-problems.html">View Problems</a></li>
          <li id="NavContact"><a href="ContactUs.html">Contact Us</a></li>
          <li style="float:right;display: flex; justify-content: flex-end;"><input type="text" name="Search" value=""
            placeholder="Search"></li>
          <li id="NavSignIn" style="float:right"><a href="login.html" id="NavSignIn">Sign In</a></li>
        </ul>
      </div>
  </nav>

  <?php if (isset($error)) : ?>
    <?php echo "lol"?>;
    <p><?php $error; ?></p>
  <?php endif; ?>

  <?php if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $valid_token = verifyCookie($token);

    if ($valid_token) {
      $_POST['step'] = 'step2';
    }
  }
  ?>

    <?php if (!isset($_POST['step']) || (isset($_POST['step']) && $_POST['step'] === 'step1')) : ?>
      <form class="mt-5" id="formResetPassword" method="POST">
        <input type="hidden" id="step" name="step" value="step1">

        <h1>Reset Password</h1>
        <p>You will receive an email containing instructions to reset your password.</p>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <input class="mb-3" type="submit" value="Submit">

        <a href="login.html">Go back to log in</a>
      </form>

      <div id="success-message" style="display: none;">
            <h3 style="text-align:center;" class="mt-5">If there is an associated account, an email containing instructions to reset your password has been sent!</h1>
      </div>

    <?php elseif (isset($_POST['step']) && $_POST['step'] === 'step2') : ?>

      <form class="mt-5" id="formResetPassword2" method="POST">
        <input type="hidden" id="step" name="step" value="step2">

        <h1>Reset Password</h1>
        <p>Please enter your new password.</p>

        <label for="password">New password:</label>
        <input type="password" id="password" name="password" minlength="8" required>
        <label for="confirm_password">Confirm password:</label>
        <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>

        <span class="mt-2 mb-2" id="error-message"></span>

        <input class="mb-3" type="submit" value="Submit">
      </form>

      <div id="success-message2" style="display: none;">
            <h1 style="text-align:center;" class="mt-5">Password reset!</h1>
      </div>
    <?php endif; ?>

  <footer id="footer">
      <div class="mt-1" style="width:45%;">
        <a href="ContactUs.html">Contact Us</a><br>
        Report a bug: CheltBugReport@email.com
      </div>
      <div class="mt-1" style="width:45%;">
        Made by TEMA TEMA inc
      </div>
      <div class="" style="width:10%;">
        <img src="../Images/tematemalogo.png" height="40px" width="40px">
      </div>
    </footer>
</body>

<script src='../JS/resetPassword.js'></script>
<script src='../JS/resetPassFormHide.js'></script>
<script src="../JS/Common.js"></script>

</html>

<?php
function verifyCookie($token) {
  if (isset($_COOKIE['token']) && $_COOKIE['token'] === $token) {
      return true;
  }
  return false;
}
?>
