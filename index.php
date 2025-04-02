<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title>Index Page</title>
	<meta charset="utf-8">
	<style >
		body{
			background:linear-gradient( to left,lightpink,crimson,lightgreen);
		}
		button{
			background-color: blue;
			padding: 10px;
			width: 25%;
			border:none;
			border-radius: 20px; 
			transition: 0.6s ease;
			margin-left: 70px;
			margin-right: 10px;
		}
		button:hover{
			transform: scale(1.1);
		}
		button a{
			color: #fff;
			text-decoration: none;
		}
		span{
			color: yellow;
		}
		.b{padding: 2%; margin-left: 30%; margin-top: 5%;}
	</style>
</head>
<body>

	<div style="width: 45%;padding: 20px; margin:0 auto;">
		<h1 align="center">Welcome to our project</h1>
	<img src="app.JPG">
	<h2 style="margin: 20px 90px;">Do You want to  <span>JOIN US </span> with </h2>
	<button><a href="regis.php"> Sign -Up</a></button> <button><a href="logg.php">Login</a></button>  
	<button class="b"><a href="sign.php"> Sign Up with Goggle </a></button> 
    </div>
</body>
</html>


