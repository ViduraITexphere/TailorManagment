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

        .search_wrapper {
            width: 600px;
            padding: 20px 40px 10px 40px;
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
                <div class="heading">
                    <h2>Manage Orders</h2>
                </div>
                <div class="search_wrapper">
                    <form action="ManageUsers.php" method="get">
                        <div class="search">
                            <form action="Manageusers.php" method="get">
                                <input type="text" name="search" placeholder="Search" class="form-control">
                            </form>

                        </div>

                    </form>
                </div>
                <div class="content">
                    <?php
                    if (isset($_GET['msg'])) {
                        $msg = $_GET['msg'];
                        echo
                        "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                           $msg
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    }

                    ?>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Customer Id</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once('../../inc/conn.php');
                            if (isset($_GET['search'])) {
                                $search = mysqli_real_escape_string($conn, $_GET['search']);
                                $query = "SELECT * FROM tbl_user WHERE (fname LIKE '%{$search}%' OR email LIKE '%{$search}%') ORDER BY id";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['fname'] ?></td>
                                        <td><?php echo $row['lname'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['pwd'] ?></td>
                                        <td><?php echo $row['contact'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['user_type'] ?></td>
                                        <td>
                                            <a href="#" class="link-dark" data-toggle="modal" data-target="#editModal">
                                                <i class="fa-solid fa-pen-to-square fs-5 me-3"></i> Edit
                                            </a>

                                            <a href="#" class="link-dark edit-link" data-toggle="modal" data-target="#addCostModal" data-order-id="<?php echo $row['order_id']; ?>" data-cus-id="<?php echo $row['cus_id']; ?>" data-tailor-id="<?php echo $row['tailor_id']; ?>">
                                                <i class="fa-solid fa-pen-to-square fs-5 me-3"></i> Edit
                                            </a>



                                        </td>

                                    </tr>
                                <?php
                                }
                            } else {
                                // check tailorId which is getting from session
                                $tailorId = $_SESSION['tailorId'];
                                // get all the orders which are related to that tailor
                                $sql = "SELECT * FROM tbl_order WHERE tailor_id = '$tailorId'";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tr>
                                        <td><?php echo $row['order_id'] ?></td>
                                        <td><?php echo $row['cus_id'] ?></td>
                                        <td><?php echo $row['order_date'] ?></td>
                                        <td><?php echo $row['category'] ?></td>
                                        <td>
                                            <a href="#" class="link-dark edit-link" data-toggle="modal" data-target="#viewMeasurementsModal" data-order-id="<?php echo $row['order_id']; ?>">
                                                <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                                            </a>
                                            <a href="#" class="link-dark edit-link" data-toggle="modal" data-target="#addCostModal" data-order-id="<?php echo $row['order_id']; ?>" data-cus-id="<?php echo $row['cus_id']; ?>" data-tailor-id="<?php echo $row['tailor_id']; ?>">
                                                <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                                            </a>


                                            <a href="delete.php?id=<?php echo $row['id'] ?>" class="link-dark">
                                                <i class="fa-solid fa-trash fs-5"></i>
                                            </a>
                                        </td>

                                    </tr>
                            <?php
                                }
                            }

                            ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- measurements view modal -->
        <div class="modal fade" id="viewMeasurementsModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Your form content goes here -->
                        <!-- Add this to your modal content -->
                        <div id="measurements">
                            <!-- This is where the measurements will be displayed -->
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- cost add moadl -->

        <div class="modal fade" id="addCostModal" tabindex="-1" role="dialog" aria-labelledby="addCostModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title" data-order-id="" data-cus-id="" data-tailor-id=""></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Display order details here -->
                        <div id="orderDetails">
                            <!-- Order details will be displayed here -->
                        </div>
                        <!-- Cost input form -->
                        <form id="costForm">
                            <div class="form-group">
                                <label for="cost">Cost:</label>
                                <input type="text" class="form-control" id="cost" name="cost">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Add this JavaScript code at the bottom of your HTML, after including the Bootstrap JavaScript libraries -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#viewMeasurementsModal').on('show.bs.modal', function(event) {
                    // Your modal logic here
                });
            });
        </script>
        <!-- Add this JavaScript code at the bottom of your HTML, after including the Bootstrap and jQuery libraries -->
        <script>
            $(document).ready(function() {
                $('.edit-link').on('click', function(event) {
                    event.preventDefault();

                    // Get the order ID from the clicked link's data attribute
                    var orderId = $(this).data('order-id');

                    // Use AJAX to fetch measurements data
                    $.ajax({
                        url: 'get_measurements.php',
                        type: 'GET',
                        data: {
                            order_id: orderId
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.error) {
                                console.error(data.error);
                            } else {
                                // Update the modal's HTML with the retrieved measurements data
                                var measurementsHtml = '';

                                if (data.shoulder !== null && data.shoulder !== undefined) {
                                    measurementsHtml += `<p><strong>Shoulder:</strong> ${data.shoulder}</p>`;
                                }
                                if (data.sleeve !== null && data.sleeve !== undefined) {
                                    measurementsHtml += `<p><strong>Sleeve:</strong> ${data.sleeve}</p>`;
                                }
                                if (data.chest !== null && data.chest !== undefined) {
                                    measurementsHtml += `<p><strong>Chest:</strong> ${data.chest}</p>`;
                                }
                                if (data.height !== null && data.height !== undefined) {
                                    measurementsHtml += `<p><strong>Height:</strong> ${data.height}</p>`;
                                }
                                if (data.vest !== null && data.vest !== undefined) {
                                    measurementsHtml += `<p><strong>Vest:</strong> ${data.vest}</p>`;
                                }
                                if (data.hem !== null && data.hem !== undefined) {
                                    measurementsHtml += `<p><strong>Hem:</strong> ${data.hem}</p>`;
                                }
                                if (data.waist !== null && data.waist !== undefined) {
                                    measurementsHtml += `<p><strong>Waist:</strong> ${data.waist}</p>`;
                                }
                                if (data.outseam !== null && data.outseam !== undefined) {
                                    measurementsHtml += `<p><strong>Outseam:</strong> ${data.outseam}</p>`;
                                }
                                if (data.inseam !== null && data.inseam !== undefined) {
                                    measurementsHtml += `<p><strong>Inseam:</strong> ${data.inseam}</p>`;
                                }
                                if (data.leg_opening !== null && data.leg_opening !== undefined) {
                                    measurementsHtml += `<p><strong>Leg Opening:</strong> ${data.leg_opening}</p>`;
                                }

                                $('#measurements').html(measurementsHtml);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
                $('#addCostModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var orderId = button.data('order-id');
                    var cusId = button.data('cus-id');
                    var tailorId = button.data('tailor-id');

                    // Use AJAX to fetch order details
                    $.ajax({
                        url: 'get_order_details.php',
                        type: 'GET',
                        data: {
                            order_id: orderId
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#addCostModal').modal('hide');
                            if (response.error) {
                                console.error(response.error);
                            } else {

                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });


                // Handle the cost submission
                // Handle the cost submission
                $('#costForm').submit(function(event) {
                    event.preventDefault();
                    var cost = $('#cost').val();
                    var orderId = $('#addCostModal .modal-title').data('order-id');
                    var cusId = $('#addCostModal .modal-title').data('cus-id');
                    var tailorId = $('#addCostModal .modal-title').data('tailor-id');

                    console.log('Cost:', cost);
                    console.log('Order ID:', orderId);
                    console.log('Customer ID:', cusId);

                    // Use AJAX to save the cost
                    $.ajax({
                        url: 'save_cost.php',
                        type: 'POST',
                        data: {
                            cus_id: cusId,
                            tailor_id: tailorId,
                            order_id: orderId,
                            cost: cost
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                // Close the modal when the save action is successful
                                $('#addCostModal').modal('hide');
                            } else {
                                console.error(response.error);
                                // Handle the error, display an error message, etc.
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('Request failed:', error);
                            console.log('Status:', status);
                            console.log('XHR:', xhr);
                        }
                    });
                });



            });
        </script>
        <script>
            $(document).ready(function() {
                $('.edit-link').on('click', function(event) {
                    event.preventDefault();

                    // Get the data attributes from the clicked "Edit" button
                    var orderId = $(this).data('order-id');
                    var cusId = $(this).data('cus-id');
                    var tailorId = $(this).data('tailor-id');

                    // Set the data attributes in the modal title for later use
                    $('#addCostModal .modal-title').data('order-id', orderId);
                    $('#addCostModal .modal-title').data('cus-id', cusId);
                    $('#addCostModal .modal-title').data('tailor-id', tailorId);

                    // Use AJAX to fetch and display order details (you'll need to implement this part)
                    // This code will depend on your backend logic for fetching order details.
                    // You need to create a script (e.g., get_order_details.php) to handle the AJAX request.
                });

                // Rest of your code...
            });
        </script>



</body>


</html>