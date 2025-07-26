<?php
// Change these
$to = "support@totemrush.org";
$discordWebhook = "https://discord.com/api/webhooks/your_webhook_here";

$name = $_POST['name'];
$email = $_POST['email'];
$ign = $_POST['ign'];
$reason = $_POST['reason'];

$message = "New Application:\nName: $name\nEmail: $email\nIGN: $ign\nReason: $reason";

// Send to email
mail($to, "New Application from $name", $message);

// Send to Discord
$discordData = json_encode(["content" => $message]);
$options = [
  'http' => [
    'header'  => "Content-type: application/json",
    'method'  => 'POST',
    'content' => $discordData,
  ],
];
$context = stream_context_create($options);
file_get_contents($discordWebhook, false, $context);

http_response_code(200);
echo "Sent!";
?>
