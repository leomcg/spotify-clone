<?php include("includes/includedFiles.php"); 

if (isset($_GET['id'])) {
  $albumId = $_GET['id'];
} else {
  header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();
?>

<div class="entityInfo">
  <div class="leftSection">
    <img src="<?php echo $album->getArtworkPath() ?>" alt="Album Cover">
  </div>

  <div class="rightSection">
    <h2><?php echo $album->getTitle() ?></h2>
    <p 
      style="cursor: pointer"
      onclick="openPage('artist.php?id=' + <?php echo $artist->getId() ?>)"
      >By <?php echo $artist->getName() ?>
    </p>
    <p><?php echo $album->getNumberOfSongs() ?> songs</p>
  </div>
</div>

<div class="trackListContainer">
  <ul class="trackList">
    <?php 
      $songIdArray = $album->getSongsIds();
      
      $i = 0;
      foreach($songIdArray as $songId) {
        $i++;
        $albumSong = new Song($con, $songId);
        $albumSongArtist = $albumSong->getArtist();
        
        echo "<li class='trackListRow' id='row-" . $i . "' onclick='setTrack(\"". $albumSong->getId() ."\", tempPlaylist, true)'>
                <div class='trackCount'>
                  <img class='trackNumber' src='assets/icons/play-white.png' alt='play button'>
                  <span clas='trackNumber'>$i .</span>
                </div>

                <div class='trackInfo'>
                  <span class='albumTrackName'>" . $albumSong->getTitle() . "</span>
                  <span class='albumArtistName'>" . $albumSongArtist->getName() . "</span>
                </div>

                <div class='trackOptions'>
                  <input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
                  <img class='optionsButton' src='assets/icons/options.png' onclick='openOptionsMenu(this, event," . $i . ")'>
                </div>

                <div class='trackDuration'>
                  <span class='trackDuration'>" . $albumSong->getDuration() . "</span>
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
</nav>