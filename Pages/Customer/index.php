<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    <!--Bootstarp css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    include_once('../../components/Header/header.php');
    ?>

    <div class="container py-5">
        <h1 class="text-center">Discover Tailors</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4 py-5">
            <!-- <div class="col">
                <div class="card">
                    <img src="../../Assets/Images/tailor1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Namal Balachandra</h5>
                        <p class="card-text">I am a tailor with 10 years of experience in the field.</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-5 mt-2">

                        <div class="rate">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span>(0 Reviews)</span>

                        </div>

                        <button class="btn btn-primary">Hire</button>
                    </div>
                </div>
            </div> -->
            <?php
            // Include your database connection script here

            // Fetch data from the database
            include_once('../../inc/conn.php');

            $query = "SELECT name, experience, reviews, id, image FROM tailors";
            $result = mysqli_query($conn, $query);

            // Check for errors, loop through the results, and create the cards
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $experience = $row['experience'];
                    $reviews = $row['reviews'];
                    $tailorId = $row['id']; // Assuming you have a unique ID for each tailor
                    $tailorImg = $row['image']; // Assuming you have a unique ID for each tailor

                    echo '<div class="col">';
                    echo '<div class="card">';
                    // echo '<img src="../../Assets/Images/tailor1.jpg" class="card-img-top" alt="...">';
                    // image url should be fetched from the database
                    echo '<img src="' . $tailorImg . '" class="card-img-top" alt="...">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $name . '</h5>';
                    echo '<p class="card-text">I am a tailor with ' . $experience . ' years of experience in the field.</p>';
                    echo '</div>';
                    echo '<div class="d-flex justify-content-between align-items-center mb-5 mt-2">';
                    echo '<div class="rate">';
                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    echo '<span>(' . $reviews . ' Reviews)</span>';
                    echo '</div>';
                    echo '<a href="../Tailor/tailorProfile.php?id=' . $tailorId . '" class="btn btn-primary">Hire</a>'; // Link to the tailor's profile
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>


        </div>
    </div>




    <!--Bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>