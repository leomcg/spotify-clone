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
    <img src="assets/icons/playlist.png" alt="Playlist logo">
  </div>

  <div class="rightSection">
    <h2><?php echo $playlist->getName() ?></h2>
    <p 
      style="cursor: pointer"
      >By <?php echo $owner->getUsername() ?>
    </p>
    <p><?php echo $playlist->getNumberOfSongs() ?> songs</p>
    <button class="button">DELETE PLAYLIST</button>
  </div>
</div>

<div class="trackListContainer">
  <ul class="trackList">
    <?php 
      $songIdArray = array(); //$album->getSongsIds();
      
      $i = 0;
      foreach($songIdArray as $songId) {
        $i++;
        $albumSong = new Song($con, $songId);
        $albumSongArtist = $albumSong->getArtist();
        
        echo "<li class='trackListRow' onclick='setTrack(\"". $albumSong->getId() ."\", tempPlaylist, true)'>
                <div class='trackCount'>
                  <img class='trackNumber' src='assets/icons/play-white.png' alt='play button'>
                  <span clas='trackNumber'>$i .</span>
                </div>

                <div class='trackInfo'>
                  <span class='albumTrackName'>" . $albumSong->getTitle() . "</span>
                  <span class='albumArtistName'>" . $albumSongArtist->getName() . "</span>
                </div>

                <div class='trackOptions' onclick='stopPropagation(event)'>
                  <img class='optionsButton' src='assets/icons/options.png'>
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
