<?php

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the step is step 1
  if ($_POST['step'] === 'step1') {
    // Validate email
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "Invalid email address";
    } else {
      // Check if email exists in database
      echo "lol";
      $user = getUserByEmail($email);
      echo "lol2";
      if (!$user) {
        $error = "User with email '$email' does not exist";
        echo "lol3";
      } else {
        // Generate one-time use tok
        echo "lol4";
        $token = generateRandomString();
        // Store token in a temporary cache (e.g. Redis)
        storeToken($token, $email);
        // Send password reset email
        $reset_url = createUrl($email, $token);
        echo "lol5";
        sendPasswordResetEmail($email, $reset_url);
        
        $success = "Password reset email has been sent to '$email'. Please follow the instructions in the email to reset your password.";
      }
    }
  } elseif ($_POST['step'] === 'step2') {
    // Validate new password
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (strlen($password) < 8) {
      $error = "Password must be at least 8 characters long";
    } elseif ($password !== $confirm_password) {
      $error = "Passwords do not match";
    } else {
      // Validate token
      $token = $_POST['token'];
      $email = verifyToken($token);
      if (!$email) {
        $error = "Invalid or expired token";
      } else {
        // Update user password in database
        $user = getUserByEmail($email);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        updateUserPassword($user['id'], $hashed_password);
        // Delete token from cache
        deleteToken($token);

        $success = "Password has been reset for user with email '$email'";
      }
    }
  }
}

// Get user by email
function getUserByEmail($email) {
  include 'dbConfig.php';
  // Sanitize the email address to prevent SQL injection attacks
  $email = mysqli_real_escape_string($connection, $email);

  // Construct the SQL query to fetch the user record
  $query = "SELECT * FROM user_table WHERE email = '$email'";

  // Execute the query and fetch the result
  $result = mysqli_query($connection, $query);

  if (!$result || mysqli_num_rows($result) === 0) {
    // User not found
    echo "user not found";
    return null;
  } else {
    // User found, return the record as an associative array
    return mysqli_fetch_assoc($result);
  }
}

// Update user password in database
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
  // Generate a random token
  $token = generateRandomString();
  // Store the token and email in an array in the $_SESSION variable
  $_SESSION['password_reset_token'] = array(
    'email' => $email,
    'token' => $token,
    'created_at' => time()
  );
  return $token;
}

function verifyToken($email, $token) {
  // Check if the token and email are stored in the $_SESSION variable
  if (isset($_SESSION['password_reset_token']) && 
      $_SESSION['password_reset_token']['email'] === $email &&
      $_SESSION['password_reset_token']['token'] === $token) {
    // Check if the token has expired (30 minutes)
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
  // Remove the password_reset_token from the $_SESSION variable
  unset($_SESSION['password_reset_token']);
}

function sendPasswordResetEmail($to, $token) {
  // Include the SendGrid dependencies.
  require_once __DIR__ . '/../vendor/autoload.php';

  echo "lol6";

  // Set the email message details.
  $from = new \SendGrid\Mail\From("marcus.abraham100@gmail.com", "TTCMM");
  $to = new \SendGrid\Mail\To($to);
  $subject = "Password Reset Request";
  $body = "Hello,\n\nPlease click on the following link to reset your password: http://localhost/TTCMM/Views/ResetPassword.php?email=?token=$token\n\nThank you.";
  $content = new \SendGrid\Mail\PlainTextContent($body);

  // Create a new SendGrid Mail object.
  $mail = new \SendGrid\Mail\Mail();
  $mail->setFrom($from);
  $mail->addTo($to);
  $mail->setSubject($subject);
  $mail->addContent($content);

  // Send the email using the SendGrid API.
  $apiKey = 'PUT_API_KEY_HERE_OR_IT_WONT_WORK';
  $sg = new \SendGrid($apiKey);

  try {
      echo "lol7";
      $response = $sg->send($mail);
      echo "lol7.5";
      print_r($response);
      return true;
  } catch (Exception $e) {
      echo "lol8";
      echo 'Caught exception: ', $e->getMessage(), "\n";
      return false;
  }
}