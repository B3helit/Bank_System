<?php static $i = 0?>
<?php
session_start();
if(isset($_GET['data'])){
    $OTP = $_GET['data'];
}
echo "Data received: " . htmlspecialchars($OTP);
if (!isset($_SESSION['userId'])) {
    header('location:login.php'); // Redirect if user is not logged in
}

if (isset($_POST['verifyOTP'])) {
    $enteredOTP = $_POST['otp'];

    // Check if the entered OTP matches the generated one
    if ($enteredOTP == $OTP) {
        // OTP verified successfully
        unset($_SESSION['otp']); // Remove OTP after successful verification
        header('location:index.php'); // Redirect to the main dashboard
    } else {
        $error = "<div class='alert alert-danger text-center rounded-0'>Incorrect OTP, please try again!</div>";
        //$i++;
        if($i==3){
            $error = "<div class='alert alert-danger text-center rounded-0'>Sorry, you have tried 3 times. You'll be directed to the main page.</div>";
            sleep(2);
            header('location:login.php');
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
</head>
<body>
    <h2>Enter OTP</h2>
    <form method="POST" action="">
        <label for="otp">OTP:</label>
        <input type="text" name="otp" required>
        <button type="submit" name="verifyOTP">Verify OTP</button>
    </form>
    <?php if (isset($error)) echo $error; ?>
</body>
</html>
