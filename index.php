<?php
session_start();
include_once('inc/conn.php');

$msg = "";

if (isset($_POST['submit'])) {
    //declaring variables and assign empty values
    $email = "";
    $password = "";

    //catch input data
    $email = input_validate($_POST['email']);
    $password = input_validate($_POST['password']);

    //INSERT Values into database
    $query1 = "SELECT * FROM tbl_user WHERE email = '{$email}' AND pwd ='{$password}' LIMIT 1";
    $showResult = mysqli_query($conn, $query1);
    $row = mysqli_fetch_array($showResult);

    if (mysqli_num_rows($showResult) == 1) {
        // Set a session variable
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_type'] = $row['user_type'];

        if ($row["user_type"] == "user") {
            header("Location: Pages/Customer/index.php");
        } elseif ($row["user_type"] == "tailor") {
            header("Location: Pages/Tailor/tailor.php");
        } elseif ($row["user_type"] == "admin") {
            header("Location: Pages/Admin/admin.php");
        } else {
            echo "error";
        }
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Please check your email or password! </strong> Enter correct credentials.
        </div>";
    }
}

function input_validate($data)
{
    //remove unwanted spaces
    $data = trim($data);
    //remove backslashes
    $data = stripslashes($data);
    //convert special chars to HTML entities
    $data = htmlspecialchars($data);
    return $data;
}

// You can add code here to fetch and display additional user details
if (isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];
    $query2 = "SELECT id, name FROM tbl_user WHERE email = '$userEmail'";
    $result2 = mysqli_query($conn, $query2);

    if (mysqli_num_rows($result2) > 0) {
        $userDetails = mysqli_fetch_assoc($result2);
        $userName = $userDetails['name'];
        $userId = $userDetails['id'];
        // Save user name and user ID in session
        $_SESSION['user_name'] = $userName;
        $_SESSION['user_id'] = $userId;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/AuthStyles/SignInPage/SignIn.css" />

</head>

<body>
    <div class="container">
        <form action="index.php" method="POST">
            <?php if (!empty($msg)) {
                echo $msg;
            } ?>

            <h2>Sign In</h2>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="sub-btn">
                <button type="submit" name="submit" class="btn btn-secondary">Login</button>
            </div>
            <div class="signup_link">
                Don't have an account?
                <a href="Pages/Auth/SignUp/signup.php">Sign Up</a>
            </div>
            <?php
            if (isset($userName) && isset($userAge)) {
                echo "<p>Logged-in user's name: $userName</p>";
                echo "<p>Logged-in user's age: $userAge</p>";
            }
            ?>
        </form>
    </div>
</body>

</html>