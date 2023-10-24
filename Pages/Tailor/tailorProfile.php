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

<?php
include_once('../../inc/conn.php');
// check there is a category in the db equal to the category in the url
//check if the category is in the db
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    echo $category;
    $sql = "SELECT * FROM categories WHERE category = '$category'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // category exists in the db
        // get the category id
        $row = $result->fetch_assoc();
        $mesurements = $row['measure'];
        echo $mesurements;
    } else {
        // category does not exist in the db
        // redirect to the tailor profile page
        header("Location: tailorProfile.php?id=$tailorId");
    }
} else {
    // no category in the url
    // redirect to the tailor profile page
    // echo "no category";
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tailor</title>
    <link rel="stylesheet" href="tailorProfile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<?php
include_once('../../components/Header/header.php');
?>
<div>

    <body>
        <h1 class="text-center"><?php echo $tailorName; ?></h1>
        <img src="<?php echo $tailorImg; ?>" alt="Tailor Image" class="profile_img">


</div>
<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <!-- Category Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-secondary" id="viewMeasurements">View Measurements</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("viewMeasurements").addEventListener("click", function() {
            var selectedCategory = document.getElementById("categorySelect").value;
            // show result with the selected category and tailor id as a parameter in same page
            window.location.href = "tailorProfile.php?id=<?php echo $tailorId; ?>&category=" + selectedCategory;

        });
    </script>


</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>