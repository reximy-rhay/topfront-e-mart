<?php
include './server.php';

    // REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $Fullname = mysqli_real_escape_string($db, $_POST['Fullname']);
    $Companyname = mysqli_real_escape_string($db, $_POST['Companyname']);
    $Businessaddress = mysqli_real_escape_string($db, $_POST['Businessaddress']);
    $Email = mysqli_real_escape_string($db, $_POST['Email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $image = mysqli_real_escape_string($db, $_POST['image']);
    
   
    
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array

  if (empty($Fullname)) { array_push($errors, "Full Name is required"); }
  if (empty($Companyname)) { array_push($errors, "Company Name is required"); }
  if (empty($Businessaddress)) { array_push($errors, "Business Address  is required"); }
  if (empty($Email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
 

  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
   // check password length if password is less then 8 character so
        if (strlen(trim($_POST['password_1'])) < 8) {
            $errors['password_1'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
       
        }
        if (strlen(trim($_POST['password_2'])) < 8) {
         
      }
        // generate a random Code
        $code = rand(999999, 111111);
        // set Status
        $status = "Not Verified";


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE  Email='$Email'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  
  if ($user) { 
    if ($user['Email'] === $Email) {
      array_push($errors, "Email already exists");
    }
}

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (Email, password, Fullname, Businessaddress, Companyname, image) 
  			  VALUES( '$Email', '$password', '$Fullname', '$Businessaddress', '$Companyname', '$image')";
  	mysqli_query($db, $query);
    
  	$_SESSION['Email'] = $Email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: ./login.php');
  }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <link rel="stylesheet" href="npm i bootstrap-icons">
     <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">HOME</a>
    
  </div>
</nav>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

               
                <form action="signup.php" method="post" class="mx-1 mx-md-4">
                <?php 
                include './errors.php';
      ?>
                  <div class="d-flex flex-row align-items-center mb-4">
                   <i class="uil uil-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" name="Fullname" class="form-control" <?php echo $Fullname; ?> required
                      placeholder="lastname and firstname"/>
                      <label class="form-label" for="form3Example1c">Full Name</label>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                  <i class="uil uil-user-plus fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c"  name="Companyname" class="form-control"  <?php echo $Companyname; ?> required  placeholder="registered company name"/>
                      <label class="form-label" for="form3Example1c">Company Name</label>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                  <i class="uil uil-envelope-alt fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" name="Businessaddress" class="form-control" <?php echo $Businessaddress; ?> required  placeholder="registered business address"/>
                      <label class="form-label" for="form3Example1c">Business Address</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                  
                  <i class="uil uil-at  fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" name="Email" class="form-control" <?php echo $Email; ?> required  placeholder="Email address"/>
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                  <i class="uil uil-key-skeleton fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" name="password_1" class="form-control"  required  placeholder="password"/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                  <i class="uil uil-key-skeleton fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd"  name="password_2" class="form-control"  required  placeholder="confirm password" />
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                  </div>
                  <span>Add company image or company logo:</span>
                  <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>

                

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg" name="reg_user">Register</button>
                  </div>
                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Already have an account?</p>
                    <a href="./login.php" class="btn btn-outline-danger">Login</a>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="./signup.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>