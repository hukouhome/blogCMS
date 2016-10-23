<?php

  $query = "SELECT * FROM categories";

  $categories = $db->query($query);

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">

    <title><?php echo $page_title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <?php if(isset($_GET['category'])) { ?>
            <a class="blog-nav-item" href="index.php">Home</a>
          <?php }else { ?>
          <a class="blog-nav-item active" href="#">Home</a>
          <?php } ?>
          <?php if($categories->num_rows > 0) {
            while($row = $categories->fetch_assoc()){
              if(isset($_GET['category']) && $row['id'] == $_GET['category'] ) {
            ?>
            <a class="blog-nav-item active" href="index.php?category=<?php echo $row['id']; ?>"><?php echo $row['text']; ?></a>
            <?php }else { ?>
              <a class="blog-nav-item" href="index.php?category=<?php echo $row['id']; ?>"><?php echo $row['text']; ?></a>
          <?php } } } ?>
        </nav>
      </div>
    </div>

    <div class="container">


      <div class="row">

        <div class="col-sm-8 blog-main">
