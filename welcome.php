<?php
 session_start();

// Check if user logged in through Google
if (!isset($_SESSION['useremail']) && !isset($_SESSION['google_name'])) {
    header("Location: logg.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<style>
		body {
			background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url("clg.JPG");
			background-size: cover;
 	         background-position: contain;
 	         color: #fff;
		}
		img {
			border-radius: 50%;
			width: 100px;
			height: 100px;
		}
		button {
			background-color: coral;
			font-size: 20px;
			padding: 7px;
			border: none;
		    border-radius: 7px;
		}
		button a {
			text-decoration: none;
			transition: 0.6s ease;
			color: #ffff;
		}
		button:hover {
			text-decoration: underline;
			color: yellow;
			transform: scale(1.1);
		}
		div {
			margin-top: 10%;
		}
	</style>
</head>
<body>
	<div align="center">
		<?php if(isset($_SESSION['google_picture'])): ?>
			<img src="<?php echo $_SESSION['google_picture']; ?>" alt="Google Profile">
		<?php else: ?>
			<img src="download.PNG" alt="Default Profile">
		<?php endif; ?>
        
        <h1 class="col-lg-5">Welcome to the App</h1>
        
        <?php if(isset($_SESSION['google_name'])): ?>
            <p class="col-sm-3">Hello, <strong><?php echo $_SESSION['google_name']; ?></strong> (<?php echo $_SESSION['google_email']; ?>)</p>
        <?php else: ?>
            <p class="col-sm-3">Hello, <strong><?php echo $_SESSION['useremail']; ?></strong></p>
        <?php endif; ?>
        
        <p>You can also log out from here</p>
        
        <button class="btn-danger col-md-3">
            <a href="logout.php">Logout</a>
        </button>
   </div>
</body>
</html>
