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
        
        echo "<li class='trackListRow' onclick='setTrack(\"". $playlistSong->getId() ."\", tempPlaylist, true)'>
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
    ?>

    <script>
      let tempSongIds = '<?php echo json_encode($songIdArray); ?>';
      tempPlaylist = JSON.parse(tempSongIds);
    </script>

  </ul>
</div>
