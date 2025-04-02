<?php
include('conn.php'); // Database connection

require_once 'vendor/autoload.php'; // Google API autoload

if(isset($_POST['btn'])) {
    $user = trim($_POST["user"]);
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["pass"];
    $confirm = $_POST["confirm"];

    // Check if username or email already exists
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user' OR email = '$email'");
    
    if ($query && $query->num_rows > 0) {
        echo "<script>alert('Username or email has already been taken');</script>";
    } else {
        if ($password === $confirm) {
            // Store the password as plain text (for practice only)
            $sql = "INSERT INTO user (username, Name, email, password) VALUES ('$user', '$name', '$email', '$password')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>alert('Registration Successful! Redirecting to login...');</script>";
                header("Location: logg.php");
                exit();
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Password Does Not Match!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("Wallpaper.JPG");
            background-size: cover;
            background-position: center;
        }

        #form {
            width: 35%;
            color: #fff;
            height: auto;
            border: 5px solid darkgray;
            border-radius: 10% 0% 20% 0%;
            padding: 10px 30px;
            margin: 0px auto;
            box-shadow: 5px 5px 5px gray;
            background: rgba(0, 0, 0, 0.4);
        }
        #button {
            background-color: blue;
            color: #fff;
            padding: 5px;
            width: 25%;
            font-size: 10px;
            border-top-left-radius: 4px;
            border: none;
            font-size: 23px;
            margin-left: 20px;
            transition: 0.3s ease;
        }
        #button:hover {
            transform: scale(1.1);
        }
        h1 {
            font-size: 30px;
            color: #fff;
            margin-left: 36%;
        }
        a {
            color: red;
            margin-left: 20px;
        }
        #g {
            font-size: 18px;
            background-color: lightblue;
            color: #fff;
            text-align: center;
        }
        #g i {
            color: purple;
            padding: 5px;
        }
        #g a {
            color: #fff;
        }
        #g a:hover {
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Welcome to Sign Up Form</h1>
    <div id="form" class="form-group">
        <form method="POST" action="" autocomplete="on">
            <h2 style="margin-left: 140px;">Sign Up</h2>
            <input type="text" name="user" id="user" class="form-control" required="" placeholder="UserName" /><br>
            <input type="text" name="name" id="name" class="form-control" required="" placeholder="Full Name"/><br>
            <input type="email" name="email" id="email" class="form-control" required="" placeholder="Email"><br>
            <input type="Password" name="pass" id="pass" class="form-control" required="" placeholder="Password"/><br>
            <input type="Password" name="confirm" id="pass2" class="form-control" required="" placeholder="Confirm Password"/><br>
            <p>__________OR __________</p>
            <div id="g">
                <p><a href="<?php echo isset($google_login_url) ? $google_login_url : '#'; ?>"><i class="fa-brands fa-google"></i> Login with Google</a></p>
            </div>
            <input type="submit" name="btn" value="Register" id="button" />
            <p>Already Registered? <a href="logg.php">Log in</a></p>
        </form>
    </div>
</body>
</html>
