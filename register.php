<?php
include('includes/classes/Account.php');

$account = new Account();

include('includes/handlers/register-handler.php');
include('includes/handlers/login-handler.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Slotify</title>
</head>

<body>
  <div id="inputContainer">
    <form method="POST" action="register.php" id="loginForm">
      <h2>Login to your account</h2>
      <p>
        <label for="loginUsername">Username</label>
        <input 
          type="text" 
          id="loginUsername" 
          name="loginUsername" 
          placeholder="e.g. bartSimpson" 
          value="<?php $_POST['loginUsername'] ?>"
          required>
      </p>
      <p>
        <label for="loginPassword">Password</label>
        <input 
          type="password" 
          id="loginPassword" 
          name="loginPassword" 
          placeholder="Your password"
          value="<?php $_POST['loginPassword'] ?>"
          required>
      </p>

      <button type="submit" name="loginButton">LOG IN</button>
    </form>

    <form method="POST" action="register.php" id="registerForm">
      <h2>Create your free account</h2>
      <p>
        <?php echo $account->getError(Constants::$usernameLength) ?>
        <label for="username">Username</label>
        <input 
          type="text" 
          id="username" 
          name="username" 
          placeholder="e.g. bartSimpson"
          value="<?php $_POST['username'] ?>"
          required>
      </p>
      <p>
        <?php echo $account->getError(Constants::$firstNameLength) ?>
        <label for="firstName">First name</label>
        <input 
          type="text" 
          id="firstName" 
          name="firstName" 
          placeholder="e.g. Bart" 
          value="<?php $_POST['firstName'] ?>"
          required>
      </p>
      <p>
        <?php echo $account->getError(Constants::$lastNameLength) ?>
        <label for="lastName">Last name</label>
        <input 
          type="text" 
          id="lastName" 
          name="lastName" 
          placeholder="e.g. Simpson" 
          value="<?php $_POST['lastName'] ?>"
          required>
      </p>
      <p>
        <?php echo $account->getError(Constants::$invalidEmail) ?>
        <?php echo $account->getError(Constants::$emailsDontMatch) ?>
        <label for="email">E-mail</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          placeholder="e.g. bart@gmail.com"
          value="<?php $_POST['email'] ?>" 
          required>
      </p>
      <p>
        <label for="email2">Confirm E-mail</label>
        <input 
          type="email" 
          id="email2" 
          name="email2" 
          placeholder="Confirm your e-mail"
          value="<?php $_POST['email2'] ?>" 
          required>
      </p>
      <p>
        <?php echo $account->getError(Constants::$invalidPassword) ?>
        <?php echo $account->getError(Constants::$passwordLength) ?>
        <?php echo $account->getError(Constants::$passwordsDontMatch) ?>
        <label for="password">Password</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          placeholder="Your password" 
          value="<?php $_POST['password'] ?>"
          required>
      </p>
      <p>
        <label for="password2">Confirm Password</label>
        <input 
          type="password" 
          id="password2" 
          name="password2" 
          placeholder="Confirm your password" 
          value="<?php $_POST['password2'] ?>"
          required>
      </p>

      <button type="submit" name="registerButton">SIGN UP</button>
    </form>

  </div>
</body>

</html>