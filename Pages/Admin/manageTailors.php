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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


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
                    // echo "<tr class='update-row' onclick='redirectToUpdateUser(" . $row['id'] . ")'>
                    // onclick redirectToUpdateUser and modal open
                    echo "<tr class='update-row' data-toggle='modal' data-target='#updateUserModal' onclick='redirectToUpdateUser(" . $row['id'] . ")'>
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

    <div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#updateUserModal').modal('hide');">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            </div>
                            <div class="modal-body">
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                            <form id="updateForm" enctype="multipart/form-data">
                        <!-- Input fields for updated values -->
                        <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter new name">
                    </div>
                        <div class="form-group">
                            <label for="experience">Experience:</label>
                            <input type="text" class="form-control" id="experience" name="experience" placeholder="Enter new experience">
                        </div>
                        <div class="form-group">
                            <label for="reviews">Reviews:</label>
                            <input type="text" class="form-control" id="reviews" name="reviews" placeholder="Enter new reviews">
                        </div>
                        <!-- upload image -->
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Enter new image">
                        </div>
                        <input type="hidden" id="currentImage" name="currentImage">

                        <div class="form-group">
                        <label for="image">Image:</label>
                        <img id="imagePreview" src="" alt="Tailor Image" style="max-width: 100px; max-height: 100px;">
                        </div>
                        
                        <div class="form-group">
                            <label for="categories">Categories:</label>
                            <input type="text" class="form-control" id="categories" name="categories" placeholder="Enter new categories">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter new username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter new password">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter new email">
                        </div>
                        <!-- user type dropdown -->
                        <div class="form-group" style="display: none;">
                        <label for="userType">User Type:</label>
                        <select class="form-control" id="userType" name="userType">
                            <option value="tailor">Tailor</option>
                        </select>
                        </div>



                        <!-- Hidden input field to store tailor ID -->
                        <input type="hidden" id="tailorId" name="tailorId">

                        <button type="button" class="btn btn-primary" onclick="updateTailor()">Update Tailor</button>
                    </div>
                </form>
            </div>
            </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Add this JavaScript code at the bottom of your HTML, after including the Bootstrap JavaScript libraries -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    function redirectToUpdateUser(tailorId) {
    // Fetch existing tailor details based on ID using AJAX
    $.ajax({
        url: 'getTailorDetails.php',
        type: 'POST',
        data: { tailorId: tailorId },
        success: function(response) {
            // Parse the JSON response (assuming your PHP returns JSON)
            var tailorDetails = JSON.parse(response);

            // Set values in the input fields
            $('#name').val(tailorDetails.name);
            $('#experience').val(tailorDetails.experience);
            $('#reviews').val(tailorDetails.reviews);

            // Set the current image value for the "choose image" box
            $('#imagePreview').attr('src', tailorDetails.image);
            $('#currentImage').val(tailorDetails.image);

            $('#categories').val(tailorDetails.categories);
            $('#username').val(tailorDetails.username);
            $('#password').val(tailorDetails.password);
            $('#email').val(tailorDetails.email);


            // Set tailor ID in the hidden input field
            $('#tailorId').val(tailorDetails.id);

            // Open the modal
            $('#updateUserModal').modal('show');
        },
        error: function(error) {
            console.log(error);
        }
    });
}







function updateTailor() {
    // Get the current image value
    var currentImage = $('#currentImage').val();

    // Get the selected image file
    var newImage = $('#image')[0].files[0];

    // Check if a new image is selected
    if (newImage) {
        // New image is selected, proceed with the file upload
        var formData = new FormData($('#updateForm')[0]);
        formData.append('currentImage', currentImage); // Pass the current image value

        // Send AJAX request to updateTailor.php with file upload
        $.ajax({
            url: 'updateTailor.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle the response (e.g., show a success message)
                console.log(response);

                // Close the modal
                $('#updateUserModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    } else {
        // No new image is selected, update tailor without file upload
        $.ajax({
            url: 'updateTailor.php',
            type: 'POST',
            data: {
                // Pass other form data here
                'currentImage': currentImage,
                // Add other form fields as needed
                'name': $('#name').val(),
                'experience': $('#experience').val(),
                'reviews': $('#reviews').val(),
                'categories': $('#categories').val(),
                'username': $('#username').val(),
                'password': $('#password').val(),
                'email': $('#email').val(),
                'userType': $('#userType').val(),
                'tailorId': $('#tailorId').val()

            },
            success: function(response) {
                // Handle the response (e.g., show a success message)
                console.log(response);

                // Close the modal
                $('#updateUserModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
}




</script>
</body>


</html>