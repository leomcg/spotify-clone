<?php include('includes/includedFiles.php');

if (isset($_GET['term'])) {
  $term = urldecode($_GET['term']);
} else {
  $term = '';
}
?>

<div class="searchContainer">
  <h4>Search for artists, albums or songs</h4>
  <input type="text" class="searchInput" placeholder="Search..." value="<?php echo $term ?>" onfocus="var val=this.value; this.value=''; this.value= val;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
</div>

<script>

$(".searchInput").focus();

  $(function() {
    let timer;

    $(".searchInput").keyup(function() {
      clearTimeout(timer);

      timer = setTimeout(function() {
        let val = $('.searchInput').val();
        openPage("search.php?term=" + val);
      }, 500);
    });
  })
</script>

<?php if($term === '') exit() ?>

<h2 class="artistPageTitle">songs</h2>
<div class="trackListContainer borderBottom">
  <ul class="trackList">
    <?php 

      $songQuery = mysqli_query($con, "SELECT id FROM Songs WHERE title LIKE '%$term%' LIMIT 10");

      if(mysqli_num_rows($songQuery) === 0) {
        echo "<span class='noResults'>No songs found matching " . $term . "</span>";
      }

      $songIdArray = array();
      
      $i = 0;
      while($row = mysqli_fetch_array($songQuery)) {
        $i++;

        array_push($songIdArray, $row['id']);

        $albumSong = new Song($con, $row['id']);
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

<h2 class="artistPageTitle">artists</h2>
<div class="artistsContainer borderBottom"> 
  <?php 
    $artistQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '%$term%' LIMIT 10");

    if(mysqli_num_rows($artistQuery) === 0) {
      echo "<span class='noResults'>No artists found matching " . $term . "</span>";
    }

    while($row = mysqli_fetch_array($artistQuery)) {
      $artistFound = new Artist($con, $row['id']);

      echo "<div class='searchResultRow'>
              <div class='searchArtistName'>
                <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() . "\")'> 
                 " . $artistFound->getName() . "
                </span>
              </div>
          </div>
      ";
    }
  ?>
</div>

<h2 class="artistPageTitle">Albums</h2>
<div class="gridViewContainer borderBottom">
	<?php
    $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '%$term%'");
    
    if(mysqli_num_rows($albumQuery) === 0) {
      echo "<span class='noResults'>No albums found matching " . $term . "</span>";
    }
    
		while ($row = mysqli_fetch_array($albumQuery)) {
      $artistId = $row['artist'];
      $artistQuery = mysqli_query($con, "SELECT * FROM artists WHERE id='$artistId'");
      $artist = mysqli_fetch_array($artistQuery);
      $artistName = $artist['name']; 

      echo "<div class='gridViewItem'>
                <span role='link' tabindex='0'> 
                    <img src='" . $row['artworkPath'] . "' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>

                    <div class='gridViewInfo'>"
                      . $row['title'] . "<br><span onclick='openPage(\"artist.php?id=" . $artistId . "\")'> by $artistName </span> " .
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
