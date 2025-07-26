CREATE TABLE submissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  discord_id VARCHAR(64),
  type VARCHAR(50),
  status ENUM('pending', 'accepted', 'denied') DEFAULT 'pending',
  answers TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
