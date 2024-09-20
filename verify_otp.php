<?php
//session_start();
//include('db.php'); // To include your database connection if needed

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$otp = trim($_POST['otp']);

    //if ($otp == $_SESSION['otp']) {
        // OTP is correct, insert user into database
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $hashed_password = $_SESSION['password'];

        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            // OTP verified, registration successful
            unset($_SESSION['otp'], $_SESSION['username'], $_SESSION['email'], $_SESSION['password']); // Clear session data
            header("Location: login.php"); // Redirect to login page
            exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error_message = "Invalid OTP. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h2>OTP Verification</h2>

    <?php if (!empty($error_message)) { ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php } ?>

    <form action="verify_otp.php" method="post">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required><br><br>
        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
