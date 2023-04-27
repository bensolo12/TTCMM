<!DOCTYPE html>
<html>
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

  <?php if (!isset($_POST['step']) || (isset($_POST['step']) && $_POST['step'] === 'step1')) : ?>
    <form id="formResetPassword" method="POST">
      <input type="hidden" name="step" value="step1">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <input type="submit" value="Submit">
    </form>
  <?php elseif (isset($_POST['step']) && $_POST['step'] === 'step2') : ?>
    <form id="formResetPassword2" method="POST">
      <input type="hidden" name="step" value="step2">
      <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
      <label for="password">New password:</label>
      <input type="password" id="password" name="password" minlength="8" required>
      <label for="confirm_password">Confirm password:</label>
      <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>
      <input type="submit" value="Submit">
    </form>
  <?php endif; ?>
</body>

<script src='../JS/resetPassword.js'></script>
</html>

