<?php
session_start();
$client_id = "YOUR_CLIENT_ID";
$redirect_uri = urlencode("YOUR_REDIRECT_URI");
$scope = "identify%20email";
$response_type = "code";
$discord_url = "https://discord.com/api/oauth2/authorize?client_id={$client_id}&redirect_uri={$redirect_uri}&response_type={$response_type}&scope={$scope}";
header("Location: $discord_url");
exit();
?>
