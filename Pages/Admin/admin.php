<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="Styles/HomePageStyles/Home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <title>Document</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        [class*="col"] {
            padding: 0;
            margin: 0;
        }

        .sidebar {
            background-color: lightblue;
            height: 100vh;
            padding: 0;
            margin: 0;
        }

        /* //////////////////////You can edit this ////////////////////// */

        .form_wrapper {
            width: 60%;
            /* background-color: #f7f7f7; */
            padding: 70px;
            margin: 0 auto;
            margin-top: 100px;
            border-radius: 4px;
        }

        .btn-secondary {
            background-color: #141414 !important;
            border: 1px solid #f7f7f7;
            color: #000;
        }

        .form-control:valid {
            border: 1px solid #4e4e4e !important;
        }

        .bootstrap-select {
            color: red !important;
            background: blue !important;
            border: 1px solid red !important;
        }
    </style>
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
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>