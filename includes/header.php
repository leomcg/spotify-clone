<?php
include('includes/config.php');
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");

if(isset($_SESSION['userLoggedIn'])) {
  $userLoggedIn = $_SESSION['userLoggedIn'];
  echo "<script>userLoggedIn = $userLoggedIn;</script>";
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
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="assets/js/script.js"></script>
  <title>Welcome to Playfy!</title>
</head>
<body>

  <div class="mainContainer">
    <div class="topContainer">

      <?php include('includes/navBarContainer.php') ?>

      <div id="mainViewContainer">
        <div id="mainContent">