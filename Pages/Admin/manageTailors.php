<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <style>
    /* //////////////////////You can edit this ////////////////////// */
    .row1 {
        display: flex;
        flex-direction: row;
    }

    .left {
        width: 15%;
    }

    .right {
        width: 85%;
    }

    .content {
        padding: 20px 40px;
        display: flex;
    }

    .heading {
        font-weight: 600;
        margin: 20px 40px;
    }
    </style>
</head>

<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container_main">
        <div class="row1">
            <div class="left">
                <?php include "../Other/Drawer.php" ?>
            </div>
            <div class="right">
            <div class="content">

            <?php
            include_once('../../inc/conn.php');
            $sql = "SELECT * FROM tailors";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                echo "<table class='table table-striped'>
                <thead class='thead-dark'>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Experience</th>
                        <th scope='col'>Reviews</th>
                        <th scope='col'>Categories</th>
                        <th scope='col'>Username</th>
                        <th scope='col'>Email</th>
                    </tr>
                </thead>
                <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr class='update-row' onclick='redirectToUpdateUser(" . $row['id'] . ")'>
                        <th scope='row'>" . $row['id'] . "</th>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['experience'] . "</td>
                        <td>" . $row['reviews'] . "</td>
                        <td>" . $row['categories'] . "</td>
                        <td>" . $row['username'] . "</td>
                        <td>" . $row['email'] . "</td>
                        
                    </tr>";
                }
                echo "</tbody>
                </table>";
            } else {
                echo "0 results";
            }
            ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function redirectToUpdateUser(tailorId) {
        // Redirect to trackOrder.php with the order_id as a query parameter
        window.location.href = 'manageTailors.php?id=' + tailorId;
}
</script>
</body>


</html>