<?php
include("includes/config.php");
include("includes/db.php");

if(isset($_GET['search'])) {
  $page_title = "Search Results for \"" . $_GET['search'] ."\"";
}

include("includes/header.php");
if(isset($_GET['search'])) {
  $keyword = mysqli_real_escape_string($db, $_GET['search']);
  $query = "SELECT * FROM posts WHERE keywords LIKE '%$keyword%'";
  $posts = $db->query($query);
}else {
  echo "<p>No Keyword!!!</p>";
}

?>
<div class="row">
  <div class="col-sm-8 blog-main">
        <br>
        <blockquote>Search Result for <?php echo @$_GET['search']; ?></blockquote>
        <?php if($posts->num_rows > 0) {
          while($row = $posts->fetch_assoc()) {
          ?>
        <div class="blog-post">
          <h2 class="blog-post-title"><a href="single.php?post=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h2>
          <p class="blog-post-meta"><?php echo $row['date']; ?> by <a href="#"><?php echo $row['author']; ?></a></p>

          <?php $body =  $row['body'];
                echo substr($body, 0, 400) . "...";
          ?>
          <a href="single.php?post=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
        </div><!-- /.blog-post -->
        <?php } }else {
          echo "<p>No Matching Posts!!</p>";
        }
        ?>



        </div><!-- /.blog-main -->

        <?php include("includes/sidebar.php"); ?>
        <?php include("includes/footer.php"); ?>
