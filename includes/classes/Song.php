<?php

class Song {
  private $id;
  private $con;
  private $title;
  private $artistId;
  private $albumId;
  private $genre;
  private $duration;
  private $path;

  public function __construct($con, $id) {
    $this->id = $id;
    $this->con = $con;

    $query = mysqli_query($this->con, "SELECT * FROM Songs WHERE id='$this->id'");
    $songs = mysqli_fetch_array($query);

    $this->title = $songs['title'];
    $this->artistId = $songs['artist'];
    $this->albumId = $songs['album'];
    $this->genre = $songs['genre'];
    $this->duration = $songs['duration'];
    $this->path = $songs['path'];
  }

  public function getTitle() {
    return $this->title;
  }

  public function getArtist() {
    return new Artist($this->con, $this->artistId);
  }

  public function getAlbum() {
    return new Album($this->con, $this->albumId);
  }

  public function getGenre() {
    return $this->genre;
  }

  public function getDuration() {
    return $this->duration;
  }

  public function getPath() {
    return $this->path;
  }
}