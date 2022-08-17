<?php
session_start();

// initializing variables
$Fullname = "";
$Companyname = "";
$Businessaddress = "";
$Email    = "";
$image ="";
$errors = array(); 


// connect to the database


$db = mysqli_connect('us-cdbr-east-06.cleardb.net', 'beef083db55fd1', 'db8e03bd', 'heroku_24e3867b057bee0');



// LOGIN USER
if (isset($_POST['login_user'])) {
    $Email = mysqli_real_escape_string($db, $_POST['Email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($Email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE Email='$Email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['Email'] = $Email;
          $_SESSION['success'] = "You are now logged in";
          header('location: ./malefashion-master/index.html');
        }else {
            array_push($errors, "Wrong email/password combination.");
        }
    }
  }

    // if forgot button will clicked
    if (isset($_POST['forgot_password'])) {
      $Email = $_POST['Email'];
      $_SESSION['Email'] = $Email;

      $emailCheckQuery = "SELECT * FROM users WHERE Email = '$Email'";
      $emailCheckResult = mysqli_query($db, $emailCheckQuery);

      // if query run
      if ($emailCheckResult) {
          // if email matched
          if (mysqli_num_rows($emailCheckResult) > 0) {
              $code = rand(999999, 111111);
              $updateQuery = "UPDATE users SET code = $code WHERE Email = '$Email'";
              $updateResult = mysqli_query($db, $updateQuery);
              if ($updateResult) {
                  $subject = 'Forgotten Password Verification Code';
                  $message = "Do not Disclose OTP To Verify your Account, Input OTP for Confirmation $code";
                  $sender = 'From: raymondogunrinde@gmail.com';

                  if (mail($Email, $subject, $message, $sender)) {
                      $message = "We've sent a verification code to your Email <br> $email"; 

                      $_SESSION['message'] = $message;
                      header('location: verifyEmail.php');
                  } else {
                      $errors['otp_errors'] = 'Failed while sending code!';
                  }
              } else {
                  $errors['db_errors'] = "Failed while inserting data into database!";
              }
          }else{
              $errors['invalidEmail'] = "Invalid Email Address";
          }
      }else {
          $errors['db_error'] = "Failed while checking email from database!";
      }
  }
if(isset($_POST['verifyEmail'])){
  $_SESSION['message'] = "";
  $OTPverify = mysqli_real_escape_string($db, $_POST['OTPverify']);
  $verifyQuery = "SELECT * FROM users WHERE code = $OTPverify";
  $runVerifyQuery = mysqli_query($db, $verifyQuery);
  if($runVerifyQuery){
      if(mysqli_num_rows($runVerifyQuery) > 0){
          $newQuery = "UPDATE users SET code = 0";
          $run = mysqli_query($db,$newQuery);
          header("location: newPassword.php");
      }else{
          $errors['verification_error'] = "Invalid Verification Code";
      }
  }else{
      $errors['db_error'] = "Failed while checking Verification Code from database!";
  }
}

// change Password
if(isset($_POST['changePassword'])){
  $password = md5($_POST['password_1']);
  $confirmPassword = md5($_POST['password_2']);
  
  if (strlen($_POST['password_1']) < 8) {
      $errors['password_error'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
  } else {
      // if password not matched so
      if ($_POST['password_1'] != $_POST['password_2']) {
        array_push($errors, "The two passwords do not match");
      } 
      if (strlen(trim($_POST['password_1'])) < 8) {
        $errors['password_1'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
   
    }
    if (strlen(trim($_POST['password_2'])) < 8) {
     
  }
      else {
          $email = $_SESSION['email'];
          $updatePassword = "UPDATE users SET password = '$password' WHERE email = '$email'";
          $updatePass = mysqli_query($db, $updatePassword) or die("Query Failed");
          $code = 0;
          
          session_destroy();
          header('location: .//login.php');
      }
  }
}

  

 


  ?>
  