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
    <p>By <?php echo $artist->getName() ?></p>
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
