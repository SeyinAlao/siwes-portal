<?php
// Start session if needed
session_start();

// Include database connection
include 'db_connect.php';
$companies_result = $conn->query("SELECT Companyname FROM companies");
$company_options = "";
if ($companies_result && $companies_result->num_rows > 0) {
    while ($row = $companies_result->fetch_assoc()) {
        $company = htmlspecialchars($row['Companyname']);
        $company_options .= "<option value='$company'>$company</option>";
    }
} else {
    $company_options = "<option disabled>No registered companies</option>";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $matric_number = $_POST['matric_number'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $department = $_POST['department'];
    $company_name = $_POST['company_name'];
    $company_address = $_POST['company_address'];
    $cgpa = $_POST['cgpa'];
    $supervisor = $_POST['supervisor'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hashing

    // Insert into database
    $sql = "INSERT INTO users (fullname, matric_number, email, phone_number, department, company_name, company_address, cgpa, supervisor, username, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $fullname, $matric_number, $email, $phone_number, $department, $company_name, $company_address, $cgpa, $supervisor, $username, $password);

    if ($stmt->execute()) {
        header("Location: signin.php"); // Redirect after successful signup
        exit();
    } else {
        error_log("Sign-up error: " . $stmt->error);
echo "Something went wrong. Please try again later.";

    }
}
?>


<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Sign Up</title>
<link rel='stylesheet' href='sign.css'>
<script src='script.js'></script>
</head>
<body>

<div class='full_box'>
<div class='purple_box'>
<h1>Welcome Back!</h1>
<p>To keep staying connected with us please login with your personal info</p>
<button class='btn sign-in-btn' onclick="location.href='signin.php'">Sign In</button>
</div>

<div class='white_box'>
<form action='' method='POST'>
<h1 class='create'>Create Account</h1>

 <!-- Personal Details -->
<div class='personal_details'>
<h4>Personal details</h4>
<div class='input-box'><input type='text' name='fullname' placeholder='Fullname' required></div>
<div class='input-box'><input type='text' name='matric_number' placeholder='Matric Number' required></div>
<div class='input-box'><input type='email' name='email' placeholder='Email' required></div>
<div class='input-box'><input type='text' name='phone_number' placeholder='Phone Number' required></div>

<div class='input-box'>
<select name='department' required>
<option value='' disabled selected>Select your department</option>
<?php
$departments = ["Software Engineering", "Information Technology", "Computer Science", "Computer Technology", "Computer Information Science"];
foreach ($departments as $department) {
    echo "<option value='$department'>$department</option>";
}
?>
</select>
</div>
</div>

 <!-- Industrial Attachment Details -->
<div class='Industrial_Details'>
<h4>Industrial Attachment Details</h4>
<div class='input-box'><input type='text' name='company_name' placeholder='Company Name' required></div>
<!-- Dropdown to Select Company -->
<div class='input-box'>
    <label for='company_dropdown' style='font-size:14px;'>Or select from registered companies:</label>
    <select id='company_dropdown' onchange='fillCompanyInput(this)'>
    <option value='' disabled selected>Choose a company</option>
    <?= $company_options ?>
</select>

</div>

<div class='input-box'><input type='text' name='company_address' placeholder='Company Address' required></div>
<input type='number' name='cgpa' placeholder='CGPA' step='0.01' min='0' max='5' required>


<div class='input-box'>
<select name='supervisor' required>
<option value='' disabled selected>Select your allocated supervisor</option>
<?php
$supervisors = [
    "SE001" => "Adeyemi Ojo (SE)", "SE002" => "Oyinlola Adekunle (SE)", "SE003" => "Olamide Ogunbiyi (SE)",
    "IT001" => "Nneoma Okoro (IT)", "IT002" => "Chukwuebuka Agu (IT)", "IT003" => "Amarachi Nwosu (IT)",
    "CS001" => "Oluwatobi Awoniyi (CS)", "CS002" => "Ayomide Oyedele (CS)", "CS003" => "Afolabi Olanrewaju (CS)",
    "CT001" => "Fatima Abdullahi (CT)", "CT002" => "Emmanuel Okeke (CT)", "CT003" => "Opeyemi Olatunde (CT)",
    "CIS001" => "Uchechukwu Nwachukwu (CIS)", "CIS002" => "Aisha Abubakar (CIS)", "CIS003" => "Oluwafemi Olowookere (CIS)"
];
foreach ($supervisors as $code => $name) {
    echo "<option value='$code'>$name</option>";
}
?>
</select>
</div>
</div>

 <!--Login Credentials -->
<div class='login_cred'>
<h4>Login Credentials</h4>
<div class='input-box'><input type='text' name='username' placeholder='Username' required></div>
<div class='input-box'><input type='password' name='password' placeholder='Password' required></div>
</div>

<button type='submit' class='btn' >Sign Up</button>
</form>
</div>
</div>


<script>
function fillCompanyInput(selectElement) {
    const selectedCompany = selectElement.value;
    document.querySelector("input[name='company_name']").value = selectedCompany;
}
</script>

</body>
</html>
