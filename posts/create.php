<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>


<?php

if (isset($_POST['submit'])) {
    if ($_POST['title'] == '' or $_Post['subtitle'] == '' or $_post['body'] == '') {
        echo "<center><h1 style='color:red;'>Please fill in all the fields correctly</h1></center>";
        // return;
    } else {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];
        $img = $_FILES['img']['name'];
        $user_id = $_SESSION['user_id'];

        $dir = 'images' . basename($img);

        $insert = $conn->prepare("INSERT INTO posts(title, subtitle, body, img, user_id) VALUES(:title, :subtitle, :body, :img, :user_id)");

        // $insert->bindParam(':title', $title);
        // $insert->bindParam(':subtitle', $subtitle);
        // $insert->bindParam(':body', $body);
        // $insert->bindParam(':img', $img);

        $insert->execute([
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':body' => $body,
            ':img' => $img,
            ':user_id' => $user_id
        ]);

        if (move_uploaded_file($_FILES['img']['tmp_name'], $dir)) {
            echo "<center><h1 style='color:green;'>Image uploaded successfully</h1></center>";
            header('location: http://localhost/Clean-Blog/index.php');
        }
    }
}

?>


<form method="POST" action="create.php" enctype="multipart/form-data">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />

    </div>

    <div class="form-outline mb-4">
        <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
    </div>

    <div class="form-outline mb-4">
        <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body"
            rows="8"></textarea>
    </div>


    <div class="form-outline mb-4">
        <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
    </div>


    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


</form>


<?php require "../includes/footer.php"; ?>