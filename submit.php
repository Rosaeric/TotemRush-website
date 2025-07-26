<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function clean($key) {
        return htmlspecialchars($_POST[$key] ?? 'Not provided');
    }

    $username    = clean("username");
    $email       = clean("email");
    $discord     = clean("discord");
    $age         = clean("age");
    $timezone    = clean("timezone");
    $country     = clean("country");
    $referral    = clean("referral");
    $why_join    = clean("why_join");
    $playstyle   = clean("playstyle");
    $experience  = clean("experience");
    $in_discord  = clean("in_discord");
    $vc_ok       = clean("vc_ok");
    $recording   = clean("recording");
    $playtime    = clean("playtime");
    $other       = clean("other");

    $webhook_url = "https://discord.com/api/webhooks/XXXX/XXXX"; // Replace this

    $json_data = json_encode([
        "content" => "<@&123456789012345678>", // Replace with staff role ID or remove if not needed
        "embeds" => [[
            "title" => "📬 New TotemRush Application",
            "color" => hexdec("5865F2"),
            "fields" => [
                ["name" => "👤 Minecraft Username", "value" => $username],
                ["name" => "📧 Email", "value" => $email],
                ["name" => "💬 Discord", "value" => $discord],
                ["name" => "🔞 Age", "value" => $age],
                ["name" => "🌐 Timezone", "value" => $timezone],
                ["name" => "🏳️ Country", "value" => $country],
                ["name" => "📥 Found Us?", "value" => $referral],
                ["name" => "❓ Why Join?", "value" => $why_join],
                ["name" => "🎮 Playstyle", "value" => $playstyle],
                ["name" => "🛠️ Experience", "value" => $experience],
                ["name" => "✅ In Discord?", "value" => $in_discord],
                ["name" => "🎤 VC OK?", "value" => $vc_ok],
                ["name" => "📹 Can Record?", "value" => $recording],
                ["name" => "🕐 Weekly Playtime", "value" => $playtime],
                ["name" => "📎 Other Info", "value" => $other]
            ],
            "footer" => ["text" => "TotemRush Application Bot"]
        ]]
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode == 204) {
        header("Location: thankyou.html");
        exit;
    } else {
        echo "<h2>❌ Failed to send your application.</h2>";
        echo "<p>HTTP Status: $httpcode</p>";
    }
} else {
    header("Location: index.html");
    exit;
}
?>
