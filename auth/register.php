<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

if (isset($_POST['submit'])) {


    if ($_POST['email'] == '' or $_POST['username'] == '' or $_POST['password'] == '') {
        echo "<script>alert('Please fill all the fields')</script>";
    } else {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $insert = $conn->prepare("INSERT INTO users (email, username, mypassword) VALUES
             (:email, :username, :mypassword)");

        $insert->execute([
            ':email' => $email,
            ':username' => $username,
            ':mypassword' => $password
        ]);
    }
    echo "<script>window.location.href = 'login.php';</script>";
    //header("location: login.php");

}



?>


<form method="POST" action="register.php">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

    </div>

    <div class="form-outline mb-4">
        <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />

    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

    </div>



    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

    <!-- Register buttons -->
    <div class="text-center">
        <p>Aleardy a member? <a href="login.php">Login</a></p>



    </div>
</form>


<?php require "../includes/footer.php"; ?>