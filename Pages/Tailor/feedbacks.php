<?php
include_once('../../inc/conn.php');
// Check if the user is logged in
if (isset($_SESSION['user_email']) && isset($_SESSION['user_type'])) {
    $userId = $_SESSION['user_id'];
    $userName = $_SESSION['user_name'];
} else {
    error_log("User not logged in");
}
?>

<?php
if (isset($_POST['submit'])) {
    // Get the data from the form
    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    $tailorId = $_POST['tailorId'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];
    $createdTime = $_POST['createdTime'];

    // set the default timezone to sri lanka. Available since PHP 5.1
    date_default_timezone_set('Asia/Colombo');
    // assign the current date/time to a variable
    $createdTime = date("Y-m-d H:i:s");


    // Insert the data into the database
    $sql = "INSERT INTO tbl_rating (user_id, tailor_id, user_name, feedback, rating, created_date) 
            VALUES ('$userId', '$tailorId', '$userName', '$feedback', '$rating', '$createdTime')";

    if ($conn->query($sql) === true) {
        echo "Feedback saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @font-face {
            font-family: myFont;
            src: url("../../Assets/fonts/NeueHansKendrick-Regular.ttf");
        }

        /* Style the review container */
        .reviews-container {
            margin-top: 30px;
            font-family: myFont;
        }

        /* Style the review text */
        .review-text {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .review-feedback {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            width: 60%;
        }

        /* Style the rating */
        .review-rating {
            font-size: 18px;
            color: #007BFF;
            margin-bottom: 10px;
        }

        /* Style the created date */
        .review-created-date {
            font-size: 14px;
            color: #999;
        }

        .btn_feedback {
            background-color: #007BFF;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        .btn_feedback:hover {
            background-color: #0069D9;
            color: white;
        }
    </style>
</head>

<body>

    <script>
        function formatTimeAgo(dateString) {
            const now = new Date();
            const date = new Date(dateString);
            const timeDifference = now - date;
            const minutesAgo = Math.floor(timeDifference / 60000);

            if (minutesAgo < 1) {
                return "Just now";
            } else if (minutesAgo === 1) {
                return "1 minute ago";
            } else if (minutesAgo < 60) {
                return minutesAgo + " minutes ago";
            } else if (minutesAgo < 1440) {
                const hoursAgo = Math.floor(minutesAgo / 60);
                return hoursAgo + " hours ago";
            } else {
                const daysAgo = Math.floor(minutesAgo / 1440);
                return daysAgo + " days ago";
            }
        }
    </script>
    <h2>Feedbacks</h2>
    <button type="button" class="btn_feedback" data-bs-toggle="modal" data-bs-target="#feedbackModal">
        Add Feedback
    </button>


    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="measurementsModalLabel">Add Feedbacks for this tailor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" id="userId" name="userId" value="<?php echo $userId; ?>">
                        <input type="hidden" id="userName" name="userName" value="<?php echo $userName; ?>">
                        <input type="hidden" id="tailorId" name="tailorId" value="<?php echo $tailorId; ?>">
                        <div class="mb-3">
                            <label for="feedback" class="form-label">Feedback</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5">
                        </div>
                        <!-- created time -->
                        <input type="hidden" id="createdTime" name="createdTime" value="<?php echo date("Y-m-d H:i:s"); ?>">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button name="submit" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="reviews-container">
        <?php
        $sql = "SELECT * FROM tbl_rating WHERE tailor_id = '$tailorId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $feedback = $row['feedback'];
                $rating = $row['rating'];
                $createdDate = $row['created_date'];
                $userName = $row['user_name'];
        ?>
                <div class="review">
                    <div class="review-header">
                        <span class="review-username"><?php echo $userName; ?></span>
                        <br>

                        <span class="review-rating">

                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                                    echo '<i class="fas fa-star"></i>';
                                } else {
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                            ?>
                        </span>
                        <span class="review-separator">|</span>
                        <span class="review-created-date">Created: <script>
                                document.write(formatTimeAgo('<?php echo $createdDate; ?>'));
                            </script></span>
                    </div>
                    <div class="review-feedback">
                        <div class="short-feedback">
                            <?php echo strlen($feedback) > 100 ? substr($feedback, 0, 100) : $feedback; ?>
                        </div>
                        <?php if (strlen($feedback) > 100) { ?>
                            <div class="full-feedback" style="display: none;"><?php echo $feedback; ?></div>
                            <a class="see-more-link" href="#">See More</a>
                        <?php } ?>
                    </div>
                </div>
                <hr class="review-separator">
        <?php
            }
        } else {
            echo "No feedbacks yet!";
        }
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const seeMoreLinks = document.querySelectorAll(".see-more-link");
            seeMoreLinks.forEach(function(link) {
                link.addEventListener("click", function(event) {
                    event.preventDefault();
                    const fullFeedback = this.previousElementSibling;
                    const shortFeedback = fullFeedback.previousElementSibling;
                    fullFeedback.style.display = "block";
                    shortFeedback.style.display = "none";
                    this.style.display = "none";
                });
            });
        });
    </script>



</body>

</html>