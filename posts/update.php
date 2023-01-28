<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

if (isset($_GET['upd_id'])) {
    $id = $_GET['upd_id'];
}


$select = $conn->query("SELECT * FROM posts WHERE id = '$id'");
$select->execute();
$rows = $select->fetch(PDO::FETCH_OBJ);

// echo $rows->img;


if (isset($_POST['submit'])) {
    if ($_POST['title'] == '' or $_POST['subtitle'] == '' or $_POST['body'] == ''/* or $_FILES['img'] == ''*/) {
        echo "<center><h3 style='color:red;'>Please fill in all the fields correctly</h3></center>";
    } else {


        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];
        $img = $_FILES['img']['name'];

        // echo $img;

        // print_r($img);

        $dir = "images/" . basename($img);


        $update = $conn->prepare("UPDATE posts SET title = :title, subtitle = :subtitle,
        body = :body, img = :img WHERE id = '$id'");

        $update->execute([
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':body' => $body,
            ':img' => $img
        ]);

        if (move_uploaded_file($_FILES['img']['tmp_name'], $dir)) {
            header('location: http://localhost/Clean-Blog/index.php');
        }
    }
}



?>


<form method="POST" enctype="multipart/form-data" action="update.php?upd_id=<?php echo $id; ?>">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" name="title" id="form2Example1" class="form-control" value="<?php echo $rows->title; ?> "
            placeholder="title" />
    </div>

    <div class="form-outline mb-4">
        <input type="text" name="subtitle" id="form2Example1" class="form-control" value="<?php echo $rows->title; ?>"
            placeholder=" subtitle" />
    </div>

    <div class="form-outline mb-4">
        <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body">
            <?php echo $rows->body; ?>
        </textarea>
    </div>

    <?php echo "<img src='images/" . $rows->img . "' width = 800px height = 300px> "; ?>

    <div class="form-outline mb-4">
        <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>


</form>


<?php require "../includes/footer.php"; ?>