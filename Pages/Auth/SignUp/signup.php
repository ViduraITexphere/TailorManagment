<?php
include_once('../../../inc/conn.php');
?>
<?php
if (isset($_POST['submit'])) {
  //declaring variables and assign empty values
  $name = "";
  $username = "";
  $email = "";
  $password = "";
  $contact = "";
  $address = "";
  $user_type = "";
  $msg = "";

  //catch input data
  $name = input_validate($_POST['name']);
  $username = input_validate($_POST['username']);
  $email = input_validate($_POST['email']);
  $password = input_validate($_POST['password']);
  $contact = input_validate($_POST['contact']);
  $address = input_validate($_POST['address']);
  // $user_type = input_validate($_POST['user_type']);
  $user_type = "user";

  $query1 = "SELECT * FROM tbl_user WHERE name = '{$name}' AND email ='{$email}'";

  $showResult = mysqli_query($conn, $query1);

  if (mysqli_num_rows($showResult) === 1) {
    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>User already exists! </strong> Please try again.
                  </div>";
  } else {
    //INSERT Values into database
    $query = "INSERT INTO tbl_user(name, username, email, pwd, contact, address, user_type) VALUES('{$name}', '{$username}', '{$email}', '{$password}', '{$contact}', '{$address}', '{$user_type}')";

    //process the query
    //need two parameter
    // mysqli_query(connection, query);
    $result = mysqli_query($conn, $query);

    if ($result) {
      $msg = "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                        <strong>User Registration Success! </strong> You can log in now.
                      </div>";
      header("Refresh:2; url=../../../index.php");
    } else {
      echo mysqli_error($conn);
    }
  }
}

function input_validate($data)
{

  //remove unwanted spaces
  $data = trim($data);
  //remove backslashes
  $data = stripcslashes($data);
  //convert special chars to html entities
  $data = htmlspecialchars($data);

  return $data;
}

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Page Title</title>
  <link rel="stylesheet" type="text/css" href="../../../css\AuthStyles\SignUpPage\signup.css" />
  <link rel="stylesheet" href="../../../bootstrap/bootstrap.min.css" />


</head>

<body>
  <div class="container">
    <form id="form" action="signup.php" method="POST">
      <?php
      if (!empty($msg)) {
        echo $msg;
      } ?>



      <h2>Sign Up</h2>
      <div class="wrapper-form">
        <div class="wrapper_row_1">
          <div class="form-group">
            <label>Name</label>
            <input id="name" type="text" class="form-control" name="name" required />
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" required />
          </div>
        </div>
        <div class="wrapper_row_1">
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input id="password" type="password" class="form-control" name="password" required />
          </div>
        </div>
        <div class="wrapper_row_1">
          <div class="form-group">
            <label>Contact No</label>
            <input type="text" class="form-control" name="contact" required />
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" required />
          </div>
        </div>

      </div>

      <input type="submit" class="submit_button" name="submit" value="Register" />
      <div class="signin_link">
        Already have an account?
        <a href="../../../index.php">Sign In</a>
      </div>
    </form>
  </div>
  <?php


  ?>
</body>

</html>