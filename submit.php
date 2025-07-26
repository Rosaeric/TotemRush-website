<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "includes/db.php";

if (!isset($_SESSION['user'])) {
  header("Location: index.html");
  exit();
}

$discord_id = $_SESSION['user']['id'];
$type = "staff";

$answers = "";
for ($i = 1; $i <= 13; $i++) {
  $q = isset($_POST["q$i"]) ? htmlspecialchars($_POST["q$i"]) : '';
  $answers .= "Q$i: $q\n\n";
}

$stmt = $db->prepare("INSERT INTO submissions (discord_id, type, status, answers) VALUES (?, ?, 'pending', ?)");
$stmt->execute([$discord_id, $type, $answers]);

header("Location: dashboard.php");
exit();
?>