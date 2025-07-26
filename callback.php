<?php
session_start();

$client_id = "YOUR_CLIENT_ID";
$client_secret = "YOUR_CLIENT_SECRET";
$redirect_uri = "YOUR_REDIRECT_URI";

if (!isset($_GET['code'])) exit("No code provided");

$code = $_GET['code'];

$data = [
  "client_id" => $client_id,
  "client_secret" => $client_secret,
  "grant_type" => "authorization_code",
  "code" => $code,
  "redirect_uri" => $redirect_uri,
  "scope" => "identify email"
];

$ch = curl_init("https://discord.com/api/oauth2/token");
curl_setopt_array($ch, [
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => http_build_query($data),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => ["Content-Type: application/x-www-form-urlencoded"]
]);
$response = json_decode(curl_exec($ch), true);
$token = $response['access_token'];

$ch = curl_init("https://discord.com/api/users/@me");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => ["Authorization: Bearer $token"]
]);
$user = json_decode(curl_exec($ch), true);

$_SESSION['user'] = $user;
header("Location: ../dashboard.php");
?>
