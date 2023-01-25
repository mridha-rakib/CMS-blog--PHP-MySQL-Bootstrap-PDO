<?php require "includes/header.php"; ?>
<?php require 'config/config.php'; ?>


<?php

$posts = $conn->query("SELECT * FROM posts");
$posts->execute();
$rows = $posts->fetchAll(PDO::FETCH_OBJ);


?>

<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">

        <?php foreach ($rows as $row) : ?>

        <!-- Post preview-->
        <div class="post-preview">
            <a href="http://localhost/clean-blog/posts/post.php?post_id=<?php echo $row->id; ?>">
                <h2 class="post-title"><?php echo  $row->title; ?></h2>
                <h3 class="post-subtitle"><?php echo  $row->subtitle; ?></h3>
            </a>
            <p class="post-meta">
                Posted by
                <a href="#!"><?php echo  $row->user_name; ?></a>
                <?php echo date('M', strtotime($row->created_at)) . ',' . date('d', strtotime($row->created_at)) . ',' . date('Y', strtotime($row->created_at)); ?>
            </p>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
        <?php endforeach; ?>
        <!-- Pager-->

    </div>
</div>

<?php require 'includes/footer.php'; ?>