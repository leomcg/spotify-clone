let currentPlaylist = [];
let audioElement;
let currentlyPlaying;
let mouseDown = false;

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
