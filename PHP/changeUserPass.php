<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['step'] === 'step1') {
    $email = $_POST['email'];
    setcookie('reset_email', $email, time() + 90000, '/');

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $user = getUserByEmail($email);

      if ($user) {
        $token = generateRandomString();
        setcookie("token", $token, time() + 86400, "/");

        $reset_url = createUrl($token);
        sendPasswordResetEmail($email, $reset_url);
      } 
    } 
  } 
  elseif ($_POST['step'] === 'step2') {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
      $error = "Passwords do not match";
    } else {
        if(isset($_COOKIE['token'])){
          $email = $_COOKIE['reset_email'];
        $user = getUserByEmail($email);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        updateUserPassword($user, $hashed_password);

        setcookie('token', '', time() - 3600, "/");
        setcookie('reset_email', '', time() - 3600, '/');
        }
    }
  }
}

function getUserByEmail($email) {
  include 'dbConfig.php';
  $email = mysqli_real_escape_string($connection, $email);
  $query = "SELECT * FROM user_table WHERE email = '$email'";
  $result = mysqli_query($connection, $query);

  if (!$result || mysqli_num_rows($result) === 0) {
    return null;
  } else {
    return mysqli_fetch_assoc($result);
  }
}

function updateUserPassword($user, $hashed_password) {
  include 'dbConfig.php';
  $sql = "UPDATE `user_table` SET `user_password` = '$hashed_password' WHERE `user_id` = '$user[user_id]'";
  mysqli_query($connection, $sql);
}

function createUrl($token) {
  $reset_url = 'http://localhost/TTCMM/Views/ResetPassword.php?token=' . urlencode($token);
  return $reset_url;
}

function generateRandomString($length = 32) {
  return bin2hex(random_bytes($length));
}

function sendPasswordResetEmail($to, $reset_url) {
  require_once __DIR__ . '/../vendor/autoload.php';

  $from = new \SendGrid\Mail\From("marcus.abraham100@gmail.com", "TTCMM");
  $toMail = new \SendGrid\Mail\To($to);
  $subject = "Password Reset Request";
  $body = "Hello,\n\nPlease click on the following link to reset your password: $reset_url\n\nThank you.";
  $content = new \SendGrid\Mail\PlainTextContent($body);

  $mail = new \SendGrid\Mail\Mail();
  $mail->setFrom($from);
  $mail->addTo($toMail);
  $mail->setSubject($subject);
  $mail->addContent($content);

  $apiKey = 'PUT-API-KEY-HERE-OR-IT-WONT-WORK-DONT-COMMIT-IT';
  $sg = new \SendGrid($apiKey);

  try {
      $response = $sg->send($mail);
      return true;

  } catch (Exception $e) {
      echo 'Caught exception: ', $e->getMessage(), "\n";
      return false;
  }
}