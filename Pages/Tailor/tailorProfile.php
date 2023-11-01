<?php
include_once('../../components/Header/header.php');
// Check if the user is logged in
if (isset($_SESSION['user_email']) && isset($_SESSION['user_type'])) {
    $userEmail = $_SESSION['user_email'];
    $userType = $_SESSION['user_type'];
    $userId = $_SESSION['user_id'];
    $userName = $_SESSION['user_name'];

    // Now you can use $userEmail and $userType in your code
    // echo "Logged-in user's email: " . $userEmail . "<br>";
    // echo "Logged-in user's type: " . $userType . "<br>";
    // echo "Logged-in user's ID: " . $userId . "<br>";
    // echo "Logged-in user's name: " . $userName . "<br>";
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
    <!-- sometimes css doesnt work here -->
    <link rel="stylesheet" href="tailorProfile.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>


    <div class="container_main">
        <div class="wrapper">
            <div class="left">
                <div class="image_carousel">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://images.tailorstore.com/YToyOntzOjU6IndpZHRoIjtiOjA7czo2OiJoZWlnaHQiO2k6MTIwMDt9/images/catalog/4480-phoenix-white.jpg" class="d-block w-100 img-fluid" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.tailorstore.com/YToyOntzOjU6IndpZHRoIjtiOjA7czo2OiJoZWlnaHQiO2k6MTIwMDt9/images/catalog/4463-olympia-light-blue.jpg" class="d-block w-100 img-fluid" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.tailorstore.com/YToyOntzOjU6IndpZHRoIjtiOjA7czo2OiJoZWlnaHQiO2k6MTIwMDt9/images/catalog/12909-hillcrest-light-blue-men-s-shirt-043df8-folded-tailor-store.jpg" class="d-block w-100 img-fluid" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="tailor_profile">
                    <!-- Tailor's profile -->
                    <div class="heading">
                        <h1 class="tailor_name"><?php echo $tailorName; ?></h1>
                        <img src="<?php echo $tailorImg; ?>" alt="Tailor Image" class="profile_img">
                    </div>
                    <div class="subHeading">
                        <h4 class="tailor_category"><?php echo $tailorCategories; ?></h4>
                    </div>
                    <br>
                    <div class="des">

                        <h4>
                            <h3>
                                Job Brief:
                            </h3>
                            <br>
                            We’re looking for Tailor to help us with our latest project. We need someone who is creative and has a good eye for detail. Tailor must be able to work independently and be able to take direction well. If you think you have what it takes, please send us your portfolio and a brief description of your experience.
                            <br>
                            <br>
                            <h3>
                                Tailor Duties:
                            </h3>
                            <br>
                            Review and approve all client design specifications
                            Maintain strict quality control standards across all aspects of checks, passes, and alterations
                            Manage all inventory and ordering of materials
                            Maintain daily work schedule
                            Oversee employee performance
                            Handle client complaints, questions, and concerns
                            Assist in recruitment and hiring of tailors
                            Meet all company minimum requirements
                            Tailor Responsibilities:
                            Create high-end fashion garments using traditional and modern techniques
                            Measure customers to determine desired fit
                            Measure and mark patterns based on customer curves and measurements
                            Use computers to enter customer measurements and designs into programs
                            Cut fabric according to patterns
                            Prepare garment pieces using tools and machines
                            Press finished garments using presses and irons
                            Finish garments with stitches and zippers
                            Seam garments by hand
                            Fit garments on customers
                            Mark tags on garments
                            Assist in cleaning and maintain work area
                            Perform other duties as assigned
                            <br>
                            <br>
                            <h3>
                                Requirements And Skills:
                            </h3>
                            <br>
                            Bachelor’s degree in fashion design or related field
                            2+ years of experience as a tailor
                            Excellent sewing and tailoring skills
                            Proficient with patternmaking and fashion design software
                            Ability to follow patterns precisely and accurately
                            Ability to produce high-quality results
                            Create high-end fashion garments using traditional and modern techniques
                            Measure customers to determine desired fit
                            Measure and mark patterns based on customer curves and measurements
                            Use computers to enter customer measurements and designs into programs
                            Cut fabric according to patterns
                            Prepare garment pieces using tools and machines
                            Press finished garments using presses and irons
                            Finish garments with stitches and zippers
                            Seam garments by hand
                            Fit garments on customers
                            Mark tags on garments
                            Assist in cleaning and maintain work area
                            Perform other duties as assigned
                            ~
                            Our company is committed to diversity and inclusion in the workplace. We encourage applications from people of all races, religions, nationalities, genders, , , and ages.
                        </h4>
                    </div>
                </div>

                <!-- Modaal Open Button -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                    Launch demo modal
                </button>
                <div class="alert_wrapper">
                    <div class="alert" id="successAlert" style="display: none;">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        This is an alert box.
                    </div>
                </div>


                <!-- <div class="alert alert-success alert-dismissible d-none" id="successAlert" role="alert">
                    Order saved successfully!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->

            </div>
        </div>
    </div>



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
                    <button type="button" class="btn btn-primary" id="saveMeasurements" disabled>Save</button>
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

                            // Add an input event listener to check for changes
                            inputField.addEventListener('input', function() {
                                checkIfAllFieldsFilled();
                            });
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
                        var fieldName = $(this).attr('name');
                        var fieldValue = $(this).val();
                        measurements[fieldName] = fieldValue;
                    });

                    // Check if all input fields are filled
                    var allFieldsFilled = Object.values(measurements).every(function(value) {
                        return value.trim() !== '';
                    });

                    if (allFieldsFilled) {
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
                                $('#categoryModal').modal('hide');
                                $('#measurementsModal').modal('hide');
                                // Show the success message
                                $('#successAlert').css('display', 'block');

                                // Close the success alert after 3 seconds
                                setTimeout(function() {
                                    $('#successAlert').alert('close');
                                }, 3000);
                            }

                        });
                    } else {
                        // Show an error message if not all fields are filled
                        alert("Please fill in all measurements before saving.");
                    }
                });

                function checkIfAllFieldsFilled() {
                    var allFieldsFilled = true;

                    $('input[type="text"]').each(function() {
                        var fieldValue = $(this).val();
                        if (fieldValue.trim() === '') {
                            allFieldsFilled = false;
                            return false; // Exit the loop early if any field is empty
                        }
                    });

                    $('#saveMeasurements').prop('disabled', !allFieldsFilled);
                }
            });



        });
    </script>

</body>

</html>