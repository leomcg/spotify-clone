let currentPlaylist = [];
let audioElement;


class Audio {
 constructor() { 
    this.audio = document.createElement('audio');
  
    this.setTrack = src => {
      this.audio.src = src;
    }

    this.play = () => {
      this.audio.play();
    }

    this.pause = () => {
      this.audio.pause();
    }
  }
}
