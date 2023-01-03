<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/icofont/icofont/icofont.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!--- datepicker link -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <title>Login</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <section class="navigation shadow-lg" id="navigation">
    <header id="header" class="fixed-top shadow-lg">
      <div class="container-fluid px-md-3 d-flex align-items-center">
        <a href="index.php" class="logo mr-auto">
          <h1 class="logo">
            <div class="icon-holder">
              <div class="icon">
                <i class="icofont-hospital"></i>
              </div>
              <span>E- hospital </span>
            </div>
          </h1>
        </a>
<a href="login.php" align="right"><div class="icon-holder">
				<div class="icon"> 
					<i class="icofont-login"></i>
				</div> 
				<span> login </span>
			</div></a>

      </div>
    </header>
  </section>

  

  <section style="margin-top: 200px;">

    <div class="row " style="justify-content: center;margin-left: 7px !important;">

      <div class="col-md-4 card-1-1 "  >
        <div class="card shadow-lg rounded-top" style="height: auto;" align="center" >
        <div id="formContent">
    <!-- Tabs Titles -->
    <h2 > Sign In </h2>
    
    <!-- Icon -->
    <div>
      <img src="img/user.png" id="icon" alt="User Icon" style="width:100px;height:100px;"/>
    </div>

    <!-- Login Form -->
    <form action="validation.php" method="post">
      <input type="email" id="login" class="fadeIn second" name="ph" placeholder="Gmail" autocomplete="off">
      <input type="password" id="password" class="fadeIn third" name="pass" placeholder="Password" autocomplete="off">
      <input type="submit" class="fadeIn fourth" value="Log In" name="submit">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="user_reg.php">Register ?</a>
    </div>
    <br>
    <br>

  </div>
      </div>

     
  </section>
  <br>
  <br>

  


</body>

</html>