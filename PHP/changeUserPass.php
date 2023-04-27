<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['step'] === 'step1') {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "Invalid email address";
    } else {
      $user = getUserByEmail($email);
      if (!$user) {
        $error = "User with email '$email' does not exist";
      } else {
        $token = generateRandomString();
        storeToken($token, $email);
        $reset_url = createUrl($email, $token);
        sendPasswordResetEmail($email, $reset_url);
        
        $success = "Password reset email has been sent to '$email'. Please follow the instructions in the email to reset your password.";
      }
    }
  } elseif ($_POST['step'] === 'step2') {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (strlen($password) < 8) {
      $error = "Password must be at least 8 characters long";
    } elseif ($password !== $confirm_password) {
      $error = "Passwords do not match";
    } else {
      $token = $_POST['token'];
      $email = verifyToken($token);
      if (!$email) {
        $error = "Invalid or expired token";
      } else {
        $user = getUserByEmail($email);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        updateUserPassword($user['id'], $hashed_password);
        deleteToken($token);

        $success = "Password has been reset for user with email '$email'";
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

    echo "user not found";
    return null;
  } else {
    return mysqli_fetch_assoc($result);
  }
}

function updateUserPassword($user_id, $hashed_password) {
  // Code to update user password in database
}

function createUrl($email, $token) {
  $reset_url = 'https://example.com/reset_password.php?email=' . urlencode($email) . '&token=' . urlencode($token);
  return $reset_url;
}

function generateRandomString($length = 32) {
  return bin2hex(random_bytes($length));
}

function storeToken($email) {
  $token = generateRandomString();
  $_SESSION['password_reset_token'] = array(
    'email' => $email,
    'token' => $token,
    'created_at' => time()
  );
  return $token;
}

function verifyToken($email, $token) {
  if (isset($_SESSION['password_reset_token']) && 
      $_SESSION['password_reset_token']['email'] === $email &&
      $_SESSION['password_reset_token']['token'] === $token) {
    $created_at = $_SESSION['password_reset_token']['created_at'];
    if (time() - $created_at > 1800) {
      deleteToken();
      return false;
    } else {
      return true;
    }
  } else {
    return false;
  }
}

function deleteToken() {
  unset($_SESSION['password_reset_token']);
}

function sendPasswordResetEmail($to, $token) {
  require_once __DIR__ . '/../vendor/autoload.php';

  $from = new \SendGrid\Mail\From("marcus.abraham100@gmail.com", "TTCMM");
  $to = new \SendGrid\Mail\To($to);
  $subject = "Password Reset Request";
  $body = "Hello,\n\nPlease click on the following link to reset your password: http://localhost/TTCMM/Views/ResetPassword.php?email=?token=$token\n\nThank you.";
  $content = new \SendGrid\Mail\PlainTextContent($body);

  $mail = new \SendGrid\Mail\Mail();
  $mail->setFrom($from);
  $mail->addTo($to);
  $mail->setSubject($subject);
  $mail->addContent($content);

  $apiKey = 'PUT_API_KEY_HERE_OR_IT_WONT_WORK';
  $sg = new \SendGrid($apiKey);

  try {
      $response = $sg->send($mail);
      return true;
  } catch (Exception $e) {
      echo 'Caught exception: ', $e->getMessage(), "\n";
      return false;
  }
}