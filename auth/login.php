<?php require '../includes/header.php'  ?>
<?php require '../config/config.php' ?>

<?php


if (isset($_SESSION['username'])) {
  header("location: http://localhost/Clean-Blog/index.php");
}


//check fo the submit
if (isset($_POST['submit'])) {
  if ($_POST['email'] == '' or $_POST['password'] == '') {
    echo '<div class="alert alert-danger" role="alert">Please fill out all the required fields.</div>';
    header('location:../index.php');
  } else {
    //take the data
    $email = $_POST['email'];
    $password = $_POST['password'];

    //write our query string
    $login = $conn->query("SELECT * FROM users WHERE email = '$email' ");

    //execute the query and then fetch the results
    $login->execute();


    $row = $login->fetch(PDO::FETCH_ASSOC);

    //do our row Count and
    if ($login->rowCount() > 0) {

      //to do our password verify + redirect to index page
      if (password_verify($password, $row['mypassword'])) {

        $_SESSION['username'] = $row['username'];
        echo '<div class="alert alert-success" role="alert">Your account has been verified successfully.</div>';
        header('location:http://localhost/Clean-Blog/index.php');
      } else {
        echo "<script>alert('Please fill all the fields')</script>";
      }
    }
  }
}
?>



<form method="POST" action="login.php">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">
        Login
    </button>

    <!-- Register buttons -->
    <div class="text-center">
        <p>
            a new member? Create an account<a href="register.php"> Register</a>
        </p>
    </div>
</form>
<?php require '../includes/footer.php' ?>