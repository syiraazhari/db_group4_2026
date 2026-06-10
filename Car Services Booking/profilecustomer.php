<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}

$host = 'localhost';
$db   = 'carservicesbooking';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed.");
}

$username = $_SESSION['user'];
$stmt = $pdo->prepare('SELECT fName, lName, username, password, email, address, contactNo, dob, role FROM account WHERE id = ?');
$stmt->execute([$username]);
$profile = $stmt->fetch();

if (!$profile) {
    die("Profile data not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <style>
        .profile-card { border: 1px solid #ddd; padding: 20px; max-width: 400px; margin: 20px auto; border-radius: 8px; }
        .logout-btn { display: inline-block; margin-top: 15px; color: red; text-decoration: none; }
    </style>
</head>
<body>

    <div class="profile-card">
        <h2>Welcome, <?php echo htmlspecialchars($profile['fName']); ?>!</h2>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($profile['fName'] . ' ' . $profile['lName']); ?></p>
        <p><strong>Email Address:</strong> <?php echo htmlspecialchars($profile['email']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($profile['contactNo'] ?? 'N/A'); ?></p>
        <p><strong>Role:</strong> <?php echo htmlspecialchars($profile['role']); ?></p>
        
        <a class="logout-btn" href="logout.php">Log Out</a>
    </div>

</body>
</html>
