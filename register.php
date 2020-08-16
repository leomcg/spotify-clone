
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
        <?php echo $account->getError('Your username must be between 5 and 25 characters long')?>
        <label for="loginUsername">Username</label>
        <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. bartSimpson" required>
      </p>
      <p>
        <label for="loginPassword">Password</label>
        <input type="password" name="loginPassword" id="loginPassword" placeholder="Your password" required>
      </p>

      <button type="submit" name="loginButton">LOG IN</button>
    </form>
    
    <form method="POST" action="register.php" id="registerForm">
      <h2>Create your free account</h2>
      <p>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="e.g. bartSimpson" required>
      </p>
      <p>
        <label for="firstName">First name</label>
        <input type="text" id="firstName" name="firstName" placeholder="e.g. Bart" required>
      </p>
      <p>
        <label for="lastName">Last name</label>
        <input type="text" id="lastName" name="lastName" placeholder="e.g. Simpson" required>
      </p>
      <p>
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="e.g. bart@gmail.com" required>
      </p>
      <p>
        <label for="email">Confirm E-mail</label>
        <input type="email" id="email" name="email2" placeholder="Confirm your e-mail" required>
      </p>


      <p>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Your password" required>
      </p>
      <p>
        <label for="password">Confirm Password</label>
        <input type="password" name="password2" id="password" placeholder="Confirm your password" required>
      </p>

      <button type="submit" name="registerButton">SIGN UP</button>
    </form>
  
  </div>
</body>
</html>