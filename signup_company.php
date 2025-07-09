<!-- PLS NOTE THAT ALMOST ALL THE EXTENSIONS WERE CHANGED FROM PHP TO HTML -->

 <?php
// Start session if needed
session_start();

// Include database connection
include 'db_connect.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Slots = $_POST['Slots'];
    $Companyname = $_POST['Companyname'];
    $Companyregnumber = $_POST['Companyregnumber'];
    $Companyemail = $_POST['Companyemail'];
    $Phonenumber = $_POST['Phonenumber'];
    $Companytype = $_POST['companytype'];
    $Companyaddress = $_POST['Companyaddress'];
    $Companyusername = $_POST['Companyusername'];
    $Companypassword = password_hash($_POST['Companypassword'], PASSWORD_DEFAULT);// Secure hashing

     $check = $conn->prepare("SELECT * FROM companies WHERE Companyemail = ? OR Companyusername = ?");
    $check->bind_param("ss", $Companyemail, $Companyusername);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Email or Username already exists.";
        exit();
    }

    // Insert into database
   $sql = "INSERT INTO companies (Slots, Companyname, Companyregnumber, Companyemail, Phonenumber, Companytype, Companyaddress, Companyusername, Companypassword)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $Slots, $Companyname, $Companyregnumber, $Companyemail, $Phonenumber, $Companytype, $Companyaddress, $Companyusername, $Companypassword);


    if ($stmt->execute()) {
        header("Location: signin_company.php"); // Redirect after successful signup
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?> 



<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Sign Up</title>
<link rel='stylesheet' href='signup_company.css'>
<script src='script.js'></script>
</head>
<body>

<div class='full_box'>
<div class='purple_box'>
<h1>Welcome Back!</h1>
<p>To keep staying connected with us please login with your personal info</p>
<button class='btn sign-in-btn' onclick="location.href='signin_company.php'">Sign In</button>
</div>

<div class='white_box'>
<form action='' method='POST'>
<h1 class='create'>Create Account</h1>

 <!-- Personal Details -->
<div class='company_details'> <!--a change of class name occoured here-->
<h4>Company Details details</h4>
<div class='input-box'><input type='text' name='Companyname' placeholder='Companyname' required></div>
<div class='input-box'><input type='text' name='Companyregnumber' placeholder='Company Reg number' required></div>
<div class='input-box'><input type='email' name='Companyemail' placeholder='Primary Email address' required></div>
<div class='input-box'><input type='text' name='Phonenumber' placeholder='Primary Phone number' required></div>
<div class='input-box'><input type='number' name='Slots' placeholder='Intership Slots Available' required></div>

<div class='input-box'>
<select name='companytype' required> <!--a change of class name occoured here-->
<option value='' disabled selected>Company Type</option>
 <?php
$companytype = ["Limited Liability Company (LLC)", "Public Limited Company(PLC)", "Sole Proprietorship", " Partnership", "NGO"];
foreach ($companytype as $Companytype) {
    echo "<option value='$Companytype'>$Companytype</option>";
}
?> 
</select>
</div>
</div>

 <!-- Industrial Attachment Details was removed,i just left the div not to cause any problems -->
<div class='Industrial_Details'>
    <div class='input-box'><input type='text' name='Companyaddress' placeholder='Company Address' required></div>
</div>

 <!--Login Credentials -->
<div class='login_cred'>
<h4>Login Credentials</h4>
<div class='input-box'><input type='text' name='Companyusername' placeholder='Company Username' required></div>
<div class='input-box'><input type='password' name='Companypassword' placeholder='Password' required></div>
</div>

<button type='submit' class='btn' >Sign Up</button>
</form>
</div>
</div>

</body>
</html>
