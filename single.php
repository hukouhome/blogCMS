<?php
include("includes/config.php");
include("includes/db.php");

if(isset($_GET['post'])) {
  $post = mysqli_real_escape_string($db, $_GET['post']);

  $p = $db->query("SELECT * FROM posts WHERE id='$post'");
  $p1 = $p->fetch_assoc();

  $page_title = $p1['title'];
}

include("includes/header.php");
if(isset($_GET['post'])) {
  $id = mysqli_real_escape_string($db, $_GET['post']);
  $query = "SELECT * FROM posts WHERE id='$id'";
}

$posts = $db->query($query);

if(isset($_POST['post_comment'])) {
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $comment = mysqli_real_escape_string($db, $_POST['comment']);

  if(isset($_POST['website'])) {
    $website = mysqli_real_escape_string($db, $_POST['website']);
  }else {
    $website = "";
  }

  $query = "INSERT INTO comments (name,comment,post,website) VALUES ('$name','$comment','$id', '$website')";
  // if($db->query($query)) {
  //   echo "<script>alert('Comment Inserted!!')</script>";
  // }else {
  //   echo "<script>alert('Comment Not Inserted!!')</script>";
  // }
  $db->query($query);
  header("Location:single.php?post=$id");
  exit();
}

$query = "SELECT * FROM comments WHERE post='$id' AND status='1'";
$comments = $db->query($query);
?>

<div class="row">
  <div class="col-sm-8 blog-main">
        <br>

        <?php if($posts->num_rows > 0) {
          while($row = $posts->fetch_assoc()) {
          ?>
        <div class="blog-post">
          <h2 class="blog-post-title"><?php echo $row['title']; ?></h2>
          <p class="blog-post-meta"><?php echo $row['date']; ?> by <a href="#"><?php echo $row['author']; ?></a></p>

          <?php echo $row['body']; ?>
        </div><!-- /.blog-post -->
        <?php } } ?>

          <blockquote><?php echo $comments->num_rows; ?> Comments</blockquote>

          <div class="comment-area">
            <form method="post">
              <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Website</label>
                <input type="text" name="website" class="form-control" id="exampleInputEmail1" placeholder="Website(Optional)">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Comment</label>
                <textarea cols="60" rows="10" name="comment" class="form-control" id="exampleInputPassword1"></textarea>
              </div>
              <button type="submit" name="post_comment" class="btn btn-primary">Post Comment</button>
            </form>

            <br>
            <br>
            <br>

            <?php while($comment = $comments->fetch_assoc()) {
              if($comment['is_admin'] != 1) {
              ?>
            <div class="comment">
              <div class="comment-head">
                <a href="#"><?php echo $comment['name']; ?></a>
                <img width="50" height="50" src="img/original.jpg" />
              </div>
              <?php echo $comment['comment']; ?>
            </div>
            <?php }else { ?>
            <div class="comment">
              <div class="comment-head">
                <a href="#"><?php echo $comment['name']; ?></a><button class="btn btn-info btn-xs">Admin</button>
                <img width="50" height="50" src="img/original.jpg" />
              </div>
              <?php echo $comment['comment']; ?>
            </div>
            <?php } } ?>

          </div>

        </div><!-- /.blog-main -->

        <?php include("includes/sidebar.php"); ?>
        <?php include("includes/footer.php"); ?>
