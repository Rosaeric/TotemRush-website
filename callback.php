<?php
session_start();

$client_id = "1398397218498805830";
$client_secret = "kWrT12-FuWcDHSO77a502kz0r3OlwfVY"; // 🔒 Replace this
$redirect_uri = "https://totemrush.org/callback.php";

if (!isset($_GET['code'])) {
  exit("No code provided");
}

$code = $_GET['code'];

$data = [
  "client_id" => $client_id,
  "client_secret" => $client_secret,
  "grant_type" => "authorization_code",
  "code" => $code,
  "redirect_uri" => $redirect_uri,
  "scope" => "identify email"
];

// Get access token
$ch = curl_init("https://discord.com/api/oauth2/token");
curl_setopt_array($ch, [
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => http_build_query($data),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => ["Content-Type: application/x-www-form-urlencoded"]
]);
$response = json_decode(curl_exec($ch), true);

$token = $response['access_token'] ?? null;
if (!$token) {
  exit("OAuth token fetch failed: " . json_encode($response));
}

// Get user info
$ch = curl_init("https://discord.com/api/users/@me");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => ["Authorization: Bearer $token"]
]);
$user = json_decode(curl_exec($ch), true);

if (!isset($user['id'])) {
  exit("Failed to fetch user: " . json_encode($user));
}

$_SESSION['user'] = $user;
header("Location: ../dashboard.php");
exit();
?>
