<?php
   include("conn.php");
    
  if(isset($_POST['btn'])){
  	$useremail= $_POST['useremail'];
  	$password = $_POST['pass'];
  	$query= ("SELECT * FROM user WHERE username = '$useremail' OR email= '$useremail' ");
  	$result= mysqli_query($conn,$query);
  
  	if(mysqli_num_rows($result) > 0 ){
  		$row = mysqli_fetch_assoc($result);
        if($password == $row['password'])
           {
        	        echo"<script>
        	               Login Successfulsly done 
        	             </script>";
        	         $_SESSION['useremail'] = $row['username'];
                     header("Location:Welcome.php");
            }
                else{
        	     echo("");
                }
  	}
  	else{
  		echo("Please enter correct ");
  	}
  }
 ?>
 
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="utf-8">
	<meta name="viweport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		body{
			background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url("development.JPG");
			background-size: cover;
			position: center;
		}
		div{
			background:linear-gradient(#56ff57,#fff67f);
			width: 30%;
			margin: 0 67%;
			padding: 10px;
			border-radius: 0% 10% 0% 10%;
            height: auto;
		}
		div form{
			margin-left: 40px;
			height: auto;
		}
		form button{
            border-radius: 10px;
         	margin-left: 10%;
         border:none; padding: 10px; width: 50%; cursor: pointer;
		}
		form a {
			margin-left: 20px;margin-right: 20px;
			border:none;  color: blue; text-decoration: none;
		}
		form a:hover{
          text-decoration: underline;
		}
	</style>s
</head>
<body >
	<div>
	  <form method="POST" action="">
	  	<h1>Login</h1>
	  	<label>Username / Email: </label>
	  	<input type="text" name="useremail" id="email" required="" /><br><br>
	  	<label>Password:</label>
	  	<input type="password" name="pass" id="pass" required="" /><br><br>
	  	<button type="submit" name="btn" class="btn-primary">Login</button> <br><br>
	  
	  	<a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-youtube"></i></a>
          <p><a href="<?php echo isset($google_login_url) ? $google_login_url : 'sign.php'; ?>"><i class="fa-brands fa-google"></i> Login with Google</a></p>
        <p>Don't have an account?</p>
	 
	  <a href="regis.php">Sign Up</a>  <a href="logout.php">Log out</a>
	  </form>
	</div>
</body>
</html>