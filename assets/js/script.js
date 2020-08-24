let currentPlaylist = [];
let audioElement;
let currentlyPlaying;


class Audio {
 constructor() {
    this.audio = document.createElement('audio');
  
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
  }
}
