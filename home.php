<?php
session_start();

// Check if user is signed in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php"); // Redirect to login page if not signed in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
<?php include 'index.php'; ?>

<div class="Home-content">
    <h1>Hi,<span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?>!</span></h1>
    <p>Welcome to your SIWES portal.Follow the guide below to complete your SIWES setup successfully.</p>
    <br>
    <div class="timeline">
    <div class="timeline-item">
        <div class="timeline-circle"></div>
        <div class="timeline-content">
            <h2>Step 1</h2>
            <p>Ensure the homepage username matches your account.</p>
        </div>
    </div>
    <div class="timeline-item right">
        <div class="timeline-circle"></div>
        <div class="timeline-content">
            <h2>Step 2</h2>
            <p>Check your profile details for accuracy.</p>
        </div>
    </div>
    <div class="timeline-item">
        <div class="timeline-circle"></div>
        <div class="timeline-content">
            <h2>Step 3</h2>
            <p>Access the logbook section and complete it.</p>
        </div>
    </div>
    <div class="timeline-item right">
        <div class="timeline-circle"></div>
        <div class="timeline-content">
            <h2>Step 4</h2>
            <p>Submit the logbook for review.</p>
        </div>
    </div>
</div>

    
</body>
</html>
