<?php
include('conn.php');

// Load Google API PHP Client Library
require_once 'vendor/autoload.php';
// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
    foreach ($env as $key => $value) {
        putenv("$key=$value");
    }
}

// Google OAuth Configuration
$clientID = getenv('GOOGLE_CLIENT_ID');
$clientSecret = getenv('GOOGLE_CLIENT_SECRET');

$redirectUri = "http://localhost/System/callback.php"; // Ensure it's callback.php

// Create Google Client
$googleClient = new Google_Client();
$googleClient->setClientId($clientID);
$googleClient->setClientSecret($clientSecret);
$googleClient->setRedirectUri($redirectUri);
$googleClient->addScope("email");
$googleClient->addScope("profile");

// Generate Google Login URL
$googleLoginURL = $googleClient->createAuthUrl();
?>
