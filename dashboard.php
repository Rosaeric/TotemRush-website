<?php
session_start();
require_once "includes/db.php";
if (!isset($_SESSION['user'])) header("Location: index.html");

$user = $_SESSION['user'];
$discord_id = $user['id'];

$stmt = $db->prepare("SELECT created_at FROM submissions WHERE discord_id = ? ORDER BY created_at DESC LIMIT 1");
$stmt->execute([$discord_id]);
$last = $stmt->fetch();
$cooldown = $last && strtotime($last['created_at']) > strtotime('-48 hours');

$stmt = $db->prepare("SELECT * FROM submissions WHERE discord_id = ? ORDER BY created_at DESC");
$stmt->execute([$discord_id]);
$submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="center-box">
    <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>

    <div class="application-card">
      <h3>Staff Application</h3>
      <?php if ($cooldown): ?>
        <p class="cooldown-msg">⏳ You’re on cooldown.</p>
      <?php else: ?>
        <a href="form.html" class="discord-login">Start Application</a>
      <?php endif; ?>
    </div>

    <h3>Your Submissions</h3>
    <?php foreach ($submissions as $row): ?>
      <div class="submission">
        📄 <?php echo $row['type']; ?> |
        🕒 <?php echo $row['created_at']; ?> |
        <span class="<?php echo $row['status']; ?>"><?php echo ucfirst($row['status']); ?></span>
      </div>
    <?php endforeach; ?>

    <a href="logout.php" class="discord-login" style="background:red;">Logout</a>
  </div>
</body>
</html>