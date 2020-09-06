<?php
include('includes/config.php');
include('includes/classes/Account.php');
include('includes/classes/Constants.php');

$account = new Account($con);

include('includes/handlers/register-handler.php');
include('includes/handlers/login-handler.php');

function getInputValue($loginUsername) {
  if (isset($_POST[$loginUsername])) {
    echo $_POST[$loginUsername];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="assets/css/register.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="assets/js/register.js"></script>
  <title>Welcome to Slotify</title>
</head>

<body>
  <script>
    $(document).ready(() => {
      $('#registerButton').click(() => {
        $('#loginForm').hide();
        $('#registerForm').show();
      })

      $('#loginForm').hide();
      $('#registerForm').show();
    });
  </script>
  <div id="background">
    <span role="link" tabindex="0" onclick="openPage('register.php')" class="logo">
      <img src="assets/icons/logo.png" alt="logo">
      <p>PLAYFY</p>
    </span>
    <div id="loginContainer">
      <div id="inputContainer">
        <form autocomplete="off" method="POST" action="register.php" id="loginForm">
          <h2>Login to your account</h2>
          <p>
            <label for="loginUsername">Username</label>
            <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. bartSimpson" value="<?php getInputValue('loginUsername') ?>" required autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            <?php $account->getError(Constants::$invalidCredentials) ?>
          </p>
          <p>
            <label for="loginPassword">Password</label>
            <input type="password" id="loginPassword" name="loginPassword" placeholder="Your password" value="<?php getInputValue('loginPassword') ?>" required>
          </p>

          <button type="submit" name="loginButton">LOGIN</button>

          <div class="hasAccountText">
            <span id="hideLogin">Don't have an account yet? Sign up here.</span>
          </div>
        </form>

        <form autocomplete="off" method="POST" action="register.php" id="registerForm">
          <h2>Create your free account</h2>
          <p>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="e.g. bartSimpson" value="<?php getInputValue('username') ?>" required>
            <?php $account->getError(Constants::$usernameLength) ?>
            <?php $account->getError(Constants::$usernameExists) ?>
          </p>
          <p>
            <label for="firstName">First name</label>
            <input type="text" id="firstName" name="firstName" placeholder="e.g. Bart" value="<?php getInputValue('firstName') ?>" required>
            <?php $account->getError(Constants::$firstNameLength) ?>
          </p>
          <p>
            <label for="lastName">Last name</label>
            <input type="text" id="lastName" name="lastName" placeholder="e.g. Simpson" value="<?php getInputValue('lastName') ?>" required>
            <?php $account->getError(Constants::$lastNameLength) ?>
          </p>
          <p>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email') ?>" required>
            <?php $account->getError(Constants::$invalidEmail) ?>
            <?php $account->getError(Constants::$emailsDontMatch) ?>
            <?php $account->getError(Constants::$emailExists) ?>
          </p>
          <p>
            <label for="email2">Confirm E-mail</label>
            <input type="email" id="email2" name="email2" placeholder="Confirm your e-mail" value="<?php getInputValue('email2') ?>" required>
          </p>
          <p>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Your password" value="<?php getInputValue('password') ?>" required>
            <?php $account->getError(Constants::$invalidPassword) ?>
            <?php $account->getError(Constants::$passwordLength) ?>
            <?php $account->getError(Constants::$passwordsDontMatch) ?>
          </p>
          <p>
            <label for="password2">Confirm Password</label>
            <input type="password" id="password2" name="password2" placeholder="Confirm your password" value="<?php getInputValue('password2') ?>" required>
          </p>

          <button type="submit" name="registerButton" id="registerButton">SIGN UP</button>
          <div class="hasAccountText">
            <span id="hideRegister">Already have an account? Log in here.</span>
          </div>
        </form>
      </div>

      <div id="loginText">
        <h1>Get great music, <br> right now</h1>
        <h2>Listen to thousands of songs for free</h2>
        <ul>
          <li><img src="assets/icons/check.png" alt="" srcset="">Discover music you'll fall in love with</li>
          <li><img src="assets/icons/check.png" alt="" srcset="">Create your own playlists</li>
          <li><img src="assets/icons/check.png" alt="" srcset="">Follow your favorite artists</li>
          <li><img src="assets/icons/check.png" alt="" srcset="">Get recommendations based on your music taste</li>
        </ul>
      </div>
    </div>
 

  </div>
</body>

</html>