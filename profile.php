<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Logout logic
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="profile-container">
        <h2>Selamat Datang!</h2>
        <p>Kelompok 11</p>
        <p>Immanuel Caecilio Satrio Wibowo (225150601111001) 
            <br>Ikhlasul Amal (225150607111018)
            <br>  Danes Deova Redina (225150607111001)
            
</p>
        <form method="post" action="">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</body>
</html>