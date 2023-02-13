<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>


<?php


$categories = $conn->query("SELECT * FROM categories");
$categories->execute();
$categories = $categories->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    if ($_POST['title'] == '' or $_POST['subtitle'] == '' or $_POST['body'] == ''/* or $_FILES['img'] == ''*/) {
        echo "<center><h3 style='color:red;'>Please fill in all the fields correctly</h3></center>";
        // return;
    } else {



        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];
        $img = $_FILES['img']['name'];
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['username'];


        // $dir = "images/" . basename($img);
        $dir = "images/" . basename($img);
        //move_uploaded_file($_FILES['img']['name'], $dir);


        $insert = $conn->prepare("INSERT INTO posts (title, subtitle, body, img, user_id, user_name) 
        VALUES(:title, :subtitle, :body, :img, :user_id, :user_name)");

        // $insert->bindParam(':title', $title);
        // $insert->bindParam(':subtitle', $subtitle);
        // $insert->bindParam(':body', $body);
        // $insert->bindParam(':img', $img);

        $insert->execute([
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':body' => $body,
            ':img' => $img,
            ':user_id' => $user_id,
            ':user_name' => $user_name,
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
        <select name="category_id" class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <?php foreach ($categories as $cat): ?>
            <option value="<?php echo $cat->name;  ?>"><?php echo $cat->name;  ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="form-outline mb-4">
        <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
    </div>


    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


</form>


<?php require "../includes/footer.php"; ?>