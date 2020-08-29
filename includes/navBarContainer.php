<div id="navBarContainer">
  <nav class="navBar">
    <span role="link" tabindex="0" onclick="openPage('index.php')" class="logo">
      <img src="assets/icons/logo.png" alt="logo">
      <p>PLAYFY</p>
    </span>

    <div class="group">
      <div role="link" tabindex="0" onclick="openPage('search.php')" class="navItem">
        <span class="navItemLink">Search
          <img src="assets/icons/search.png" alt="Search">
        </span>
      </div>
    </div>

    <div class="group">
      <div role="link" tabindex="0" onclick="openPage('browse.php')" class="navItem">
        <span class="navItemLink">Browse</span>
      </div>

      <div role="link" tabindex="0" onclick="openPage('yourMusic.php')" class="navItem">
        <span class="navItemLink">Your Music</span>
      </div>

      <div role="link" tabindex="0" onclick="openPage('profile.php')" class="navItem">
        <span class="navItemLink"><?php echo $userLoggedIn ?></span>
      </div>
    </div>
  </nav>
</div>