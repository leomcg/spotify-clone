<?php 
include('includes/includedFiles.php');
?>

<div class="playlistContainer">
  <h1 class="pageHeadingBig">Playlists</h1>
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
      $playlist = new Playlist($con, $row['id']);
      $playlistId = $playlist->getId();
      $i = 0;
     
      echo 
      "<div class='gridViewPlaylist' role='link' tabindex='0' onclick='openPlaylist(" . $playlistId . ")'>
        <img class='playlistImage' src='assets/icons/playlist.png'>
        <div class='playlistName'>". $playlist->getName() ."</div>
        <img class='chevron' id='chevron-" . $playlistId . "' src='assets/icons/chevron-down.png'>
      </div>
      
      <div class='trackListContainer'>
        <ul class='trackList'>";

      $songIdArray = $playlist->getSongsIds();
      ?>
      <script>
        let tempSongIds = '<?php echo json_encode($songIdArray); ?>';
        tempPlaylist = JSON.parse(tempSongIds);
      </script>
      <?php
      
      foreach($songIdArray as $songId) {
        $i++;
        $playlistSong = new Song($con, $songId);
        $songArtist = $playlistSong->getArtist();
        
        echo 
        "<li style='display: none' class='trackListRow playlist-" . $playlistId . "'onclick='setTrack(\"". $playlistSong->getId() ."\", tempPlaylist, true); console.log(tempPlaylist)';>
          <div class='trackCount'>
            <img class='trackNumber' src='assets/icons/play-white.png' alt='play button'>
            <span clas='trackNumber'>$i .</span>
          </div>

          <div class='trackInfo'>
            <span class='albumTrackName'>" . $playlistSong->getTitle() . "</span>
            <span class='albumArtistName'>" . $songArtist->getName() . "</span>
          </div>

          <div class='trackOptions' onclick='stopPropagation(event)'>
            <img class='optionsButton' src='assets/icons/options.png'>
          </div>

          <div class='trackDuration'>
            <span class='trackDuration'>" . $playlistSong->getDuration() . "</span>
          </div>
        </li>";
      }
     
      echo 
      " </ul>
      </div>";
     
    }
    ?>
    
  <div>
</div>



<div class="modal" onclick="$('.modal').hide()">
  <form action="#" class="prompt" onclick="event.stopPropagation();" onsubmit="createPlaylist();">
    <div class="close" onclick="$('.modal').hide()">&#10005;</div>
    <input class="promptInput" type="text" placeholder="Playlist name..." autocomplete="off" autocorrect="off"
      autocapitalize="off" spellcheck="false">
    <button type="submit" class="button green">Create</button>
  </form>
</div>