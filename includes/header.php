<?php
include('includes/config.php');
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");

if(isset($_SESSION['userLoggedIn'])) {
  $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
  header("Location: register.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <link href=<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/script.js"></script>
  <title>Welcome to Playfy!</title>
</head>
<body>

<script>

  let audioElement = new Audio();
  audioElement.setTrack('assets/music/bensound-energy.mp3');
  audioElement.audio.play();

</script>

  <div class="mainContainer">
    <div class="topContainer">

      <?php include('includes/navBarContainer.php') ?>

      <div id="mainViewContainer">
        <div id="mainContent">