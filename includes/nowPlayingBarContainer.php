<?php
$songQuery = mysqli_query($con, "SELECT id FROM Songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while($row = mysqli_fetch_array($songQuery)) {
  array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>

<script>
  
  $(document).ready(() => {
    currentPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(currentPlaylist[0], currentPlaylist, false);
  });

  function setTrack(trackId, newPlaylist, play) {
    
    $.post('includes/handlers/ajax/getSongJson.php', { songId: trackId }, (data) => {
      let track = JSON.parse(data);

      $.post('includes/handlers/ajax/getArtistJson.php', { artistId: track.artist }, (data) => {
        let artist = JSON.parse(data);
        $('.artistName').text(artist.name);
      });

      $.post('includes/handlers/ajax/getAlbumJson.php', { albumId: track.album }, (data) => {
        let album = JSON.parse(data);
        $('.albumArtwork').attr('src', album.artworkPath);
      });
      
      audioElement.setTrack(track.path);
      
      $('.trackName').text(track.title);
    })    

    if(play) {
      audioElement.play();
    }
  }

  function playSong() {
    $('.play').hide()
    $('.pause').show()
    audioElement.play();
  }

  function pauseSong() {
    $('.pause').hide()
    $('.play').show() 
    audioElement.pause();
  }

</script>


<div id="nowPlayingBarContainer">
  <div id="nowPlayingBar">
    <div id="nowPlayingLeft">
      <div class="content">
        <span class="albumLink">
          <img class="albumArtwork" src="" alt="generic cover">
        </span>
        <div class="trackInfo">
          <span class="trackName"></span>
          <span class="artistName">Leonardo Gonçalves</span>
        </div>
      </div>
    </div>

    <div id="nowPlayingCenter">
      <div class="content playerControls">
        <div class="buttons">
          <button class="controlButton shuffle">
            <img src="assets/icons/shuffle.png" alt="shuffle">
          </button>
          <button class="controlButton previous">
            <img src="assets/icons/previous.png" alt="previous">
          </button>
          <button class="controlButton play">
            <img src="assets/icons/play2.png" alt="play" onclick="playSong()">
          </button>
          <button class="controlButton pause" style="display: none;" onclick="pauseSong()">
            <img src="assets/icons/pause2.png" alt="pause">
          </button>
          <button class="controlButton next">
            <img src="assets/icons/next.png" alt="next">
          </button>
          <button class="controlButton repeat">
            <img src="assets/icons/repeat.png" alt="repeat">
          </button>
        </div>
      </div>
      <div class="playbackBar">
        <span class="progressTime current">0.00</span>
        <div class="progressBar">
          <div class="progressBarBg">
            <div class="progress"></div>
          </div>
        </div>
        <span class="progressTime remaining">0.00</span>
      </div>
    </div>

    <div id="nowPlayingRight">
      <div class="volumeBar">
        <button class="controlButton volume" title="Volume button">
          <img src="assets/icons/volume.png" alt="Volume">
        </button>
        <div class="progressBar">
          <div class="progressBarBg">
            <div class="progress"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>