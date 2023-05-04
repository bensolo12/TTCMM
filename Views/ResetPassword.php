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
  <?php if (isset($error)) : ?>
    <p><?php echo $error; ?></p>
  <?php endif; ?>

  <?php if (isset($success)) : ?>
    <p><?php echo $success; ?></p>
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
      <input type="hidden" name="step" value="step1">

      <h1>Reset Password</h1>
      <p>You will receive an email containing instructions to reset your password.</p>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <input class="mb-3" type="submit" value="Submit">

      <a href="login.html">Go back to log in</a>
    </form>
  <?php elseif (isset($_POST['step']) && $_POST['step'] === 'step2') : ?>

    <form class="mt-5" id="formResetPassword2" method="POST">
      <input type="hidden" name="step" value="step2">

      <h1>Reset Password</h1>
      <p>Please enter your new password.</p>

      <label for="password">New password:</label>
      <input type="password" id="password" name="password" minlength="8" required>
      <label for="confirm_password">Confirm password:</label>
      <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>
      <input class="mb-3" type="submit" value="Submit">
    </form>
  <?php endif; ?>
</body>

<script src='../JS/resetPassword.js'></script>
</html>

<?php

function verifyCookie($token) {
  if (isset($_COOKIE['token']) && $_COOKIE['token'] === $token) {
      return true;
  }
  return false;
}

?>