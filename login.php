<?php
session_start();

$client_id = "1398397218498805830";
$redirect_uri = urlencode("https://totemrush.org/callback.php");
$scope = "identify email";
$response_type = "code";

$discord_url = "https://discord.com/oauth2/authorize?client_id=$client_id&redirect_uri=$redirect_uri&response_type=$response_type&scope=$scope";

header("Location: $discord_url");
exit();
?>
