<!-- PLS NOTE THAT ALMOST ALL THE EXTENSIONS WERE CHANGED FROM PHP TO HTML -->
 <!-- PLS NOTE THAT UNLIKE SIGNUP PAGE, NO CHAGES WERE MADE TO THE PHP OF THESE CODE -->

 <?php
session_start();
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
   $sql = "SELECT id, Companyusername, Companypassword FROM companies WHERE Companyemail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
         if (password_verify($password, $row['Companypassword'])) {
            $_SESSION['company_id'] = $row['id'];
            $_SESSION['company_username'] = $row['Companyusername'];

            header("Location: Reportform.html");
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email.";
    }
}
?>

<!DOCTYPE html>
<html lang='en'>
 <head>
  <meta charset='UTF-8'>
     <meta name='viewport' content='width=device-width, initial-scale=1.0'>
         <title>Company Sign-in</title>
          <link rel='stylesheet' href='signin_company.css'>
          <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <script src='script.js'></script>
</head>
<body>
             <div class='container' id='container'>

      <div class='form-container sign-in-container'>
    <form action="signin_company.php" method="POST">
    <h1>Company Sign-in</h1>
   
        <div class='infield'><input type="email" placeholder="Email" name="email"/><label></label></div>
      <div class='infield'><input type="password" placeholder="Password" name="password" id="password"/>
      <i class='bx bx-show' id="togglePassword" style="cursor: pointer;"></i>
      <label></label>

      <!-- <?php 
      if (isset($error) && $_SERVER["REQUEST_METHOD"] == "POST") { ?>
    <p style="color: red;"><?= $error ?></p>
<?php } 
?> -->

    </div>
          <a href="a" class='forgot'>Forgot your password?</a>
          <button type="submit">Sign In</button>
         </form>
</div>

    <div class='overlay-container'>
       <div class='overlay'>
     <div class='overlay-panel overlay-right'>
          <h1>New here?</h1>
          <p>Create an account and start your journey with us!</p>
          <button onclick="window.location.href='signup_company.php'">Sign Up</button>
             </div>
</div>
</div>
</div>
</body>
</html>

