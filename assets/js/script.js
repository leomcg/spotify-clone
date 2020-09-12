let currentPlaylist = [];
let shuffledPlaylist = [];
let tempPlaylist = [];
let audioElement;
let currentlyPlaying;
let mouseDown = false;
let currentIndex = 0;
let repeat = false;
let shuffle = false;

function playFirstSong() {
  setTrack(tempPlaylist[0], tempPlaylist, true);
}

function openOptionsMenu(button, event, i) {
  event.stopPropagation();

  const menu = $('.optionsMenu');
  const menuWidth = menu.width()

  const scrollTop = $(window).scrollTop(); // Distance from top of window to top of document
  const elementOffset = $(button).offset().top; // Distance fom top of document

  const top = elementOffset - scrollTop;
  const left = $(button).position().left;
 
  menu.css({
    'top': top + 'px',
    'left': left + 'px',
    'display': 'inline'
  });

  $('.optionsMenu').hover(
  () => {
    $('#row-' + i).css('background-color', '#282828');
    i = null;
  }, 
  () => {
    $('.trackListRow').css('background-color', '#181818');
  })
}

function openPlaylist(id) {
  $('#chevron-' + id).toggleClass('rotated');
  $('.playlist-' + id).toggleClass('visible');
}

function openModal() {
  $('.modal').css('display', 'flex');
  $('.promptInput').focus();
  $('.promptInput').val('');
}

function createPlaylist() {
  const playlistName = $('.promptInput').val();
  
  $.post("includes/handlers/ajax/createPlaylist.php", { name: playlistName, username: userLoggedIn })
  .done((error) => {

    if(error) {
      alert(error);
      return;
    }

    openPage("yourMusic.php");
  })
}

function deletePlaylist(id) {
  const prompt = confirm("Delete playlist?");

  if(prompt) {
    $.post("includes/handlers/ajax/deletePlaylist.php", { playlistId: id })
    .done((error) => {
  
      if(error) {
        alert(error);
        return;
      }
  
      openPage("yourMusic.php");
    })
  }
}

function stopPropagation(event) {
  $(".trackOptions").click(() => {
    event.stopPropagation(event);
  });
}


function openPage(url) {
  if (url.indexOf('?') === -1) {
    url = url + '?'
  }

  const encodedUrl = encodeURI(url + '&userLoggedIn=' + userLoggedIn);
  $('#mainContent').load(encodedUrl);

  $('body').scrollTop(0);

  history.pushState(null, null, url);
}

function shuffleArray(array) {
  for (var i = array.length - 1; i > 0; i--) {
    var j = Math.floor(Math.random() * (i + 1));
    var temp = array[i];
    array[i] = array[j];
    array[j] = temp;
  }
}

function formatTime(secs) {
  const time = Math.round(secs);
  const minutes = Math.floor(time / 60);
  let seconds = time - (minutes * 60);

  if (seconds < 10) {
    seconds = '0' + seconds;
  }

  return minutes + ":" + seconds;
}

function updateTimeProgressBar(audio) {
  $('.progressTime.current').text(formatTime(audio.currentTime));
  $('.progressTime.remaining').text(formatTime(audio.duration - audio.currentTime));

  const progress = audio.currentTime / audio.duration * 100;
  $('.playbackBar .progress').css('width', progress + '%');
}

function updateVolumeProgressBar(audio) {
  let volume = audio.volume * 100;
  $('.volumeBar .progress').css('width', volume + '%');

}


class Audio {
 constructor() {
    this.audio = document.createElement('audio');

    this.audio.addEventListener('ended', function() {
      nextSong()
    });

    this.audio.addEventListener('canplay', function() {
      $('.progressTime.remaining').text(formatTime(this.duration));
    });

    this.audio.addEventListener('timeupdate', function() {
      if(this.duration) {
        updateTimeProgressBar(this);
      }
    });

    this.audio.addEventListener('volumechange', function() {
      updateVolumeProgressBar(this);
    });
  
    this.setTrack = (track) => {
      this.currentlyPlaying = track;
      this.audio.src = track.path;
    }

    this.play = () => {
      this.audio.play();
    }

    this.pause = () => {
      this.audio.pause();
    }

    this.setTime = (seconds) => {
      this.audio.currentTime = seconds
    }
  }
}
