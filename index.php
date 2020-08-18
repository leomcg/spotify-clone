<?php
include('includes/config.php');

// if(isset($_SESSION['userLoggedIn'])) {
//   $userLoggedIn = $_SESSION['userLoggedIn'];
// } else {
//   header("Location: register.php");
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Document</title>
</head>
<body>

  <div class="mainContainer">
    <div class="topContainer">

      <?php include('includes/navBarContainer.php') ?>

      <div id="mainViewContainer">
        <div id="mainContent">

        </div>
      </div>

    </div>

    <?php include('includes/nowPlayingBarContainer.php') ?>
  
  </div>

 
</body>
</html>