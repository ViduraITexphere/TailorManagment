<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tailor</title>
    <!-- <link rel="stylesheet" href="tailorProfile.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">




</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php include "../Other/Drawer.php" ?>
            </div>
            <div class="col-md-10">
                <div class="content">
                    <div>
                    </div>
                    <div class="content_wrapper">
                        <?php if (isset($_SESSION['tailorId'])) { ?>
                            <form action="index.php" method="post">
                                <button type="submit" name="logout-submit">Logout</button>
                            </form>
                            <!--console log the session variables-->
                            <script>
                                console.log(<?php echo json_encode($_SESSION); ?>);
                            </script>
                        <?php } else { ?>
                            <form action="../../index.php" method="post">
                                <button type="submit" name="login-submit">Login</button>
                            </form>
                        <?php } ?>

                        <?php
                        if (isset($_SESSION['tailorEmail'])) {
                            echo $_SESSION['userName'];
                            echo $_SESSION['tailorId'];
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
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>

</html>