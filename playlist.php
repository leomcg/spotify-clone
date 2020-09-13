<?php include("includes/includedFiles.php"); 

if (isset($_GET['id'])) {
  $playlistId = $_GET['id'];
} else {
  header("Location: index.php");
}

$playlist = new playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());

?>

<div class="entityInfo">
  <div class="leftSection">
    <img class="playlistIcon" src="assets/icons/playlist.png" alt="Playlist logo">
  </div>

  <div class="rightSection">
    <h2><?php echo $playlist->getName() ?></h2>
    <p 
      style="cursor: pointer"
      >By <?php echo $owner->getUsername() ?>
    </p>
    <p><?php echo $playlist->getNumberOfSongs() ?> songs</p>
    <button class="button green" onclick="playFirstSong()">play</button>
    <button class="button delete" onclick="deletePlaylist('<?php echo $playlistId ?>')">DELETE PLAYLIST</button>
  </div>
</div>

<div class="trackListContainer">
  <ul class="trackList">
    <?php 
      $songIdArray = $playlist->getSongsIds();
      
      $i = 0;
      foreach($songIdArray as $songId) {
        $i++;
        $playlistSong = new Song($con, $songId);
        $songArtist = $playlistSong->getArtist();
        
        echo "<li class='trackListRow' id='row-" . $i . "' onclick='setTrack(\"". $playlistSong->getId() ."\", tempPlaylist, true)'>
                <div class='trackCount'>
                  <img class='trackNumber' src='assets/icons/play-white.png' alt='play button'>
                  <span clas='trackNumber'>$i .</span>
                </div>

                <div class='trackInfo'>
                  <span class='albumTrackName'>" . $playlistSong->getTitle() . "</span>
                  <span class='albumArtistName'>" . $songArtist->getName() . "</span>
                </div>

                <div class='trackOptions'>
                  <input type='hidden' class='songId' value='" . $playlistSong->getId() . "'>
                  <img class='optionsButton' src='assets/icons/options.png' onclick='openOptionsMenu(this, event," . $i . ")'>
                </div>

                <div class='trackDuration'>
                  <span class='trackDuration'>" . $playlistSong->getDuration() . "</span>
                </div>
        
              </li>";
      
      
      }
    ?>

    <script>
      let tempSongIds = '<?php echo json_encode($songIdArray); ?>';
      tempPlaylist = JSON.parse(tempSongIds);
    </script>

  </ul>
</div>

<nav class="optionsMenu" onmouseover="$(this).show()" onmouseout="$(this).hide()">
  <input type="hidden" class="songId">
  <div class="item">
    <input type="hidden" class="songId">
    <img src="assets/icons/playlist.png" alt="" srcset="">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
  </div>
  <div class="item">
    <img src="assets/icons/micro.png" alt="" srcset="">
    <span>Go to artist</span> 
  </div>
  <div class="item">
    <img src="assets/icons/share.png" alt="" srcset="">
    <span>Share</span> 
  </div>
  <div class="item" onclick="deleteFromPlaylist(this, '<?php echo $playlistId ?>')">
    <img src="assets/icons/trash.png" alt="" srcset="">
    <span>Remove</span> 
  </div>
</nav>
