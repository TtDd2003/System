<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'config.php';
include('conn.php');

session_start();

// Check if Google sent back an authorization code
if (isset($_GET['code'])) {
    $token = $googleClient->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token["error"])) {
        $googleClient->setAccessToken($token['access_token']);

        // Get user profile information
        $google_service = new Google_Service_Oauth2($googleClient);
        $data = $google_service->userinfo->get();

        // Store user data in session
        $_SESSION['google_id'] = $data['id'];
        $_SESSION['google_name'] = $data['name'];
        $_SESSION['google_email'] = $data['email'];
        $_SESSION['google_picture'] = $data['picture'];

        // Redirect to welcome page
        header('Location: welcome.php');
        exit();
    } else {
        echo "Google Authentication Failed!";
    }
} else {
    echo "No authorization code received.";
}
?>

<!--// This $_GET['code'] variable value reciever afrer clicking of button and redirect to PHP script then the value has been recieved./
// To exchange an authorization code, it can be changed the form access token..//
