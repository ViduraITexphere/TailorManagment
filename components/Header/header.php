<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../../Pages/Customer/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

</head>

<body>
    <header>
        <div class="logo">Your Logo</div>
        <div class="user">
            <?php
            session_start();
            if (isset($_SESSION['user_email'])) {
                echo '<span class="username">' . $_SESSION['user_email'] . '</span>';
            } else {
                echo '<span class="username">Your Username</span>';
            }
            ?>
            <div class="dropdown">
                <button class="dropbtn">Profile</button>
                <div class="dropdown-content">
                    <a href="../../Pages/Customer/userProfile.php">Profile</a>
                    <a href="../Auth/Logout/Logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>