<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer</title>
</head>

<body>
    <div>
        <h1>Customer Page</h1>
    </div>

    <?php if (isset($_SESSION['user_email'])) { ?>
        <form action="index.php" method="post">
            <button type="submit" name="logout-submit">Logout</button>
        </form>
    <?php } else { ?>
        <form action="../../index.php" method="post">
            <button type="submit" name="login-submit">Login</button>
        </form>
    <?php } ?>

    <?php
    if (isset($_SESSION['user_email'])) {
        echo $_SESSION['user_email'];
        echo $_SESSION['user_type'];
    } else {
        echo "Please login first";
    }

    if (isset($_POST['logout-submit'])) {
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
        exit();
    }
    ?>
</body>

</html>