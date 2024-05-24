<?php

require_once __DIR__ . '/database.php';

use Config\Database;

try {
    $connection = Database::getConnection();

    $adminUsername = 'admin';

    $stmt = $connection->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->bind_param('s', $adminUsername);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['COUNT(*)'];

    if ($count === 0) {
        $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);

        $stmt = $connection->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param('ss', $adminUsername, $adminPassword);
        $stmt->execute();
    }

} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}