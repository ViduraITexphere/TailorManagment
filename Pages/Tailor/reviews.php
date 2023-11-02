<style>
    .checked {
        color: orange;
    }

    .review .fa-star:not(.checked) {
        color: black;
    }

    @font-face {
        font-family: myFont;
        src: url("../../Assets/fonts/NeueHansKendrick-Regular.ttf");
    }

    body {
        font-family: myFont;
    }

    .main {
        display: flex;
        flex-direction: row;
        gap: 10px;

    }
</style>
<div class="main">


    <div class="review">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>

    </div>

    <?php
    $totalRatings = 0;
    $totalRatingSum = 0;

    $sql = "SELECT * FROM tbl_rating WHERE tailor_id = '$tailorId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $feedback = $row['feedback'];
            $rating = $row['rating'];
            $createdDate = $row['created_date'];
            $userName = $row['user_name'];
            $totalRatings++;
            $totalRatingSum += $rating;
        }
    } else {
        echo "No feedbacks yet!";
    }

    $averageRating = $totalRatingSum / $totalRatings;
    // Round the average rating to the nearest whole number
    $averageRatingRound = round($averageRating);


    ?>
    <span class="review-separator">|</span>
    <div class="avarage_rate">
        <p>Average Rating: <?php echo number_format($averageRating, 2); ?></p>
    </div>
</div>

<script>
    // Replace the number 3 with the actual number of reviews you want
    const numberOfReviews = <?php echo $averageRatingRound; ?>;

    // Select the review container
    const reviewContainer = document.querySelector(".review");

    // Select all the star icons in the review container
    const starIcons = reviewContainer.querySelectorAll(".fa-star");

    // Loop through the star icons and add the 'checked' class to the desired number of stars
    for (let i = 0; i < numberOfReviews; i++) {
        starIcons[i].classList.add("checked");
    }
</script>