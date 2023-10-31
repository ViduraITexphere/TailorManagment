<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['user_email']) && isset($_SESSION['user_type'])) {
    $userEmail = $_SESSION['user_email'];
    $userType = $_SESSION['user_type'];
    $userId = $_SESSION['user_id'];
    $userName = $_SESSION['user_name'];

    // Now you can use $userEmail and $userType in your code
    echo "Logged-in user's email: " . $userEmail . "<br>";
    echo "Logged-in user's type: " . $userType . "<br>";
    echo "Logged-in user's ID: " . $userId . "<br>";
    echo "Logged-in user's name: " . $userName . "<br>";
} else {
    // User is not logged in, handle accordingly
}
?>
<?php
include_once('../../inc/conn.php');

if (isset($_GET['id'])) {
    $tailorId = $_GET['id'];

    // Query the database to get the tailor's details based on the ID
    $sql = "SELECT name, image, categories FROM tailors WHERE id = $tailorId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tailorName = $row['name'];
        $tailorImg = $row['image']; // Assuming 'image' is the column name for the image
        $tailorCategories = $row['categories']; // Assuming 'categories' is the column name for the categories
    } else {
        // Handle the case where no tailor with the given ID was found
        $tailorName = "Tailor Not Found";
    }
} else {
    // Handle the case where no ID is provided in the URL
    $tailorName = "Invalid Request";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tailor</title>
    <link rel="stylesheet" href="tailorProfile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- tailors profile -->
    <h1 class="text-center"><?php echo $tailorName; ?></h1>
    <img src="<?php echo $tailorImg; ?>" alt="Tailor Image" class="profile_img">
    <br>
    <br>
    <!-- echo user id and tailor id -->
    <h1 class="text-center">User ID: <?php echo $userId; ?></h1>
    <h1 class="text-center">Tailor ID: <?php echo $tailorId; ?></h1>

    <!-- Modaal Open Button-->
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#categoryModal">
        Launch demo modal
    </button>




    <!-- Modal- Category -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select a Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" id="categorySelect">
                                        <?php
                                        // Assuming $tailorCategories is a comma-separated string of categories
                                        $categories = explode(',', $tailorCategories);
                                        foreach ($categories as $category) {
                                            echo "<option>$category</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary" id="viewMeasurements" data-bs-toggle="modal" data-bs-target="#measurementsModal">View Measurements</button>
                </div>
            </div>
        </div>
    </div>

    <!----------------------------------------------------------------------------------------------------------------------------------------->


    <!-- Modal- Measurements -->
    <div class="modal fade" id="measurementsModal" tabindex="-1" aria-labelledby="measurementsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="measurementsModalLabel">Measurements for Selected Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="measurementsPlaceholder">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveMeasurements">Save</button>
                </div>
            </div>
        </div>
    </div>



    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#categorySelect').on('change', function() {
                var category = $("#categorySelect").val();
                $.ajax({
                    url: "getMeasurements.php",
                    type: "POST",
                    data: {
                        category: category
                    },
                    success: function(data) {
                        var measurements = JSON.parse(data);

                        // Clear any existing content in the measurementsPlaceholder
                        $('#measurementsPlaceholder').empty();

                        // Generate input fields and labels for each measurement
                        measurements.forEach(function(measurement) {
                            var inputField = document.createElement('input');
                            inputField.type = 'text';
                            inputField.name = measurement;
                            inputField.placeholder = measurement;
                            inputField.className = 'form-control';

                            // Create a label element
                            var label = document.createElement('label');
                            label.innerHTML = measurement; // Use the measurement as the label text




                            // Create a container div to hold the label and input
                            var container = document.createElement('div');
                            container.appendChild(label);
                            container.appendChild(inputField);

                            // Append the container to the measurementsPlaceholder
                            $('#measurementsPlaceholder').append(container);
                        });
                    }
                });

                $('#saveMeasurements').on('click', function() {
                    // Get tailor ID and user ID
                    var tailorId = <?php echo $tailorId; ?>;
                    var userId = <?php echo $userId; ?>;
                    var category = $("#categorySelect").val();

                    // Collect the measurements
                    var measurements = {};
                    $('input[type="text"]').each(function() {
                        measurements[$(this).attr('name')] = $(this).val();
                    });

                    // Send the data to the server using AJAX
                    $.ajax({
                        url: "saveMeasurements.php",
                        type: "POST",
                        data: {
                            tailorId: tailorId,
                            userId: userId,
                            category: category,
                            measurements: JSON.stringify(measurements)
                        },
                        success: function(response) {
                            // Handle the server's response (if needed)
                            console.log(response);
                        }
                    });
                });



            });
        });
    </script>




</body>

</html>