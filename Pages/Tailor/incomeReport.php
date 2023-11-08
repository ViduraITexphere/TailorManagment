<?php
session_start();
include_once('../../inc/conn.php');

$total_rate = 0;


if (isset($_POST['filter'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];
    $fromDate = $_POST['from_date'];
    $toDate = $_POST['to_date'];

    $tailorId = $_SESSION['tailorId'];

    // Construct the SQL query based on the selected options
    $sql = "SELECT * FROM tbl_cost WHERE tailor_id = $tailorId";

if ($month != "") {
    $sql .= " AND MONTH(orderrequest_date) = '$month'";
}
if ($year != "") {
    $sql .= " AND YEAR(orderrequest_date) = '$year'";
}
if ($fromDate != "" && $toDate != "") {
    $sql .= " AND orderrequest_date BETWEEN '$fromDate' AND '$toDate'";
}

    $result = mysqli_query($conn, $sql);
} else {
    $tailorId = $_SESSION['tailorId'];
    $sql = "SELECT * FROM tbl_cost WHERE tailor_id = $tailorId"; // Adjust this line to include tailor_id in the filter
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("SQL Error: " . mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Document</title>
    <style>
    .row1 {
        display: flex;
        flex-direction: row;

    }

    .left {
        width: 15%;
    }

    .right {
        width: 85%;
        display: flex;
        flex-direction: column;
    }

    .content {
        padding: 20px 40px;
        display: flex;
        flex-direction: column;
    }

    .search_wrapper {
        width: 600px;
        padding: 20px 40px 10px 40px;
    }

    .heading {
        font-weight: 600;
        margin: 20px 40px;
    }

    .row_total {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;


    }
    .filter_btn{
        margin-top: 20px;
        width: 100px;
        height: 40px;
        background-color: #2ecc71;
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: 600;
    }
    .filter_btn:hover{
        background-color: #27ae60;
    }
    </style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container_main">
        <div class="row1">
            <div class="left">
                <?php include "../Other/Drawer.php" ?>

            </div>
            <div class="right">
                <div class="heading">
                    <h2>Tailor Management System - Tailor Income Details</h2>
                    <form method="POST" action="incomeReport.php">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="month">Select Month:</label>
                                    <select id="month" name="month" class="form-control">
                                        <option value="">Select Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year">Select Year:</label>
                                    <input type="text" name="year" class="form-control" placeholder="Insert Year">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="month">From Date:</label>
                                    <input type="date" class="form-control" name="from_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year">To Date:</label>
                                    <input type="date" class="form-control" name="to_date">
                                </div>
                            </div>
                        </div>

                        <button class="filter_btn" type="submit" name="filter">Filter</button>
                    </form>

                </div>
                <div class="content">
                    <?php
                    $tailorId = $_SESSION['tailorId'];
                    // console log 
                    echo "<script>console.log('Debug Objects: " . $tailorId . "' );</script>";
                    if (isset($fromDate) && isset($toDate)) {
                    ?>
                    <h4 class="text-center">Report From: <?php echo $fromDate; ?> - <?php echo $toDate; ?></h4>

                    <?php
                    }

                    ?>
                    <p class="lead"><button id="pdf" class="btn btn-danger">Download Report as PDF</button></p>

                    <table class="table table-striped" id="income_report">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Cost ID</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Customer ID</th>
                                <th scope="col">Tailor ID</th>
                                <th scope="col">Order Request Date</th>
                                <th scope="col">Cost</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $total_rate += $row['cost'];
                            ?>

                            <tr>
                                <td><?php echo $row['cost_id']; ?></td>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['cus_id']; ?></td>
                                <td><?php echo $row['tailor_id']; ?></td>
                                <td><?php echo $row['orderrequest_date']; ?></td>
                                <td><?php echo $row['cost']; ?></td>

                            </tr>
                            <?php
                            }


                            ?>



                        </tbody>
                    </table>
                    <div>
                        <div class="row_total">
                            <div>
                                <h2>Total : </h2>
                            </div>
                            <div>
                                <h2> Rs. <?php echo $total_rate; ?>.00</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Rest of the HTML code -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.10/jspdf.plugin.autotable.min.js"></script>

    <script src="../../JavaScript/tableHTMLExport.js"></script>
    
    <script>
    $('#pdf').on('click', function() {
        var file_name = "income_report";
        $("#income_report").tableHTMLExport({
            type: 'pdf',
            filename: file_name + '.pdf'
        });
    })
    </script>



</body>

</html>