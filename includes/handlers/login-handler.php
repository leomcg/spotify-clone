<?php 

if(isset($_POST['loginButton'])) {

  $username = $_POST['loginUsername'];
  $password = $_POST['loginPassword'];

  $wasSuccessful = $account->login($username, $password);

  if($wasSuccessful) {
    $_SESSION['userLoggedIn'] = $username;
    header("Location: index.php");
  }
  
}