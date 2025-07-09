<?php

session_start();
include 'index.php'; 

 
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); 
define('DB_PASS', ''); 
define('DB_NAME', 'mysiwes');  

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $stmt = $conn->prepare("SELECT fullname, username, email, department, company_address, phone_number, company_name, matric_number FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($fullname, $username, $email, $department, $company_address, $phone_number, $company_name, $matric_number);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();

?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css"> 
 <title>Profile</title>
</head>
<body>
<main class="profile-container force-center">
        <h2 class="title" style="color: #c2c2c2;">YOUR PERSONAL PROFILE INFO</h2>
        <div class="profile-content">
            <div class="profile-section">
                <label>Full Name <input type="text" value="<?= htmlspecialchars($fullname ?? '') ?>" readonly></label>
                <label>Username (not your e-mail) <input type="text" value="<?= htmlspecialchars($username ?? '') ?>" readonly></label>
                <label>Email <input type="email" value="<?= htmlspecialchars($email ?? '') ?>" readonly></label>
                <label>Department <input type="text" value="<?= htmlspecialchars($department ?? '') ?>" readonly></label>
            </div>
            <div class="profile-section">
                <br>
                <label>Company Address <input type="text" value="<?= htmlspecialchars($company_address ?? '') ?>" readonly></label>
                <label>Phone Number <input type="text" value="<?= htmlspecialchars($phone_number ?? '') ?>" readonly></label>
                <label>Company Name <input type="text" value="<?= htmlspecialchars($company_name ?? '') ?>" readonly></label>
                <label>Matric Number <input type="text" value="<?= htmlspecialchars($matric_number ?? '') ?>" readonly></label>
            </div>
        </div>
    </main>
</body>
</html>
