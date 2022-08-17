<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
</head>

    <style>
        @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}
    </style>
   
        <section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
         
          <div class="card-body p-4 p-md-5">
          <div id="container">
        <h2>Email</h2>
        <p>It's quick and easy.</p>
        <div id="line"></div>
        <form action="verifyEmail.php" method="POST" autocomplete="off">
            <?php
            if(isset($_SESSION['message'])){
                ?>
                <div id="alert"><?php echo $_SESSION['message']; ?></div>
                <?php
            }
            ?>

            <?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div id="alert"><?php echo $displayErrors; ?></div>
                <?php
                }
            }
            ?>      
            
                <?php include('errors.php'); ?>
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Forgot password</h5>

                  <div class="form-outline mb-4">
                    <input type="number" id="form2Example17" class="form-control form-control-lg" name="OTPverify" placeholder="Verification Code" required/>
                    <label class="form-label" for="form2Example17">Input Email</label>
                  </div>

                  <input type="submit" name="verifyEmail" class="btn btn-outline-success btn-lg" value="Verify">
                
        </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </div>
</body>
</html>