<?php include('includes/includedFiles.php');

if (isset($_GET['id'])) {
  $artistId = $_GET['id'];
} else {
  header('Location: index.php');
}

$artist = new Artist($con, $artistId);
?>

<div class="entityInfo borderBottom">
  <div class="centerSection">
    <div class="artistInfo">
      <h1 class="albumArtistName"><?php echo $artist->getName() ?></h1>
      <div class="headerButtons">
        <button class="button green" onclick="playFirstSong()">play</button>
      </div>
    </div>
  </div>
</div>

<h2 class="artistPageTitle">songs</h2>
<div class="trackListContainer borderBottom">
  <ul class="trackList">
    <?php 
      $songIdArray = $artist->getSongsIds();
      
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

<h2 class="artistPageTitle">Albums</h2>
<div class="gridViewContainer">
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist='$artistId'");
    
		while ($row = mysqli_fetch_array($albumQuery)) {
      $artistId = $row['artist'];
      $artistQuery = mysqli_query($con, "SELECT * FROM artists WHERE id='$artistId'");
      $artist = mysqli_fetch_array($artistQuery);
      $artistName = $artist['name']; 

      echo "<div class='gridViewItem'>
                <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'> 
                    <img src='" . $row['artworkPath'] . "'>

                    <div class='gridViewInfo'>"
                      . $row['title'] . "<br><span> by $artistName </span> " .
                    "</div>
                </span>
            </div>";
  	}
	?>

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

