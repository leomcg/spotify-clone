<?php 
include('includes/includedFiles.php');
?>

<div class="playlistContainer">
  <h1 class="pageHeadingBig">Playlists</h1>
  <div class="gridViewContainer">
    <div class="buttonItems">
      <button class="button green" onclick="openModal()">new playlist</button>
    </div>
    <?php
    $username = $userLoggedIn->getUsername();
    $playlistQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username'");
    
    if(mysqli_num_rows($playlistQuery) === 0) {
      echo "<span class='noResults'>You don't have any playlists yet.</span>";
    }
    
		while ($row = mysqli_fetch_array($playlistQuery)) {

      $playlist = new Playlist($con, $row);

      echo "<div class='gridViewPlaylist' role='link' tabindex='0'onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>
                <img class='playlistImage' src='assets/icons/playlist.png'>
                
                <div class='playlistName'>". $playlist->getName() ."</div>
					  </div>";

  	}
	  ?>
  </div>
</div>



<div class="modal" onclick="$('.modal').hide()">
  <form action="#" class="prompt" onclick="event.stopPropagation();" onsubmit="createPlaylist();">
    <div class="close" onclick="$('.modal').hide()">&#10005;</div>
    <input class="promptInput" type="text" placeholder="Playslist name..." autocomplete="off" autocorrect="off"
      autocapitalize="off" spellcheck="false">
    <button type="submit" class="button green">Create</button>
  </form>
</div>