<?php

class Song {
  private $id;
  private $con;
  private $myqsqliData;
  private $title;
  private $artistId;
  private $albumId;
  private $genre;
  private $duration;
  private $path;

  public function __construct($con, $id) {
    $this->id = $id;
    $this->con = $con;

    $query = mysqli_query($this->con, "SELECT * FROM songs WHERE id='$this->id'");
    $this->myqsqliData = mysqli_fetch_array($query);

    $this->title = $this->myqsqliData['title'];
    $this->artistId = $this->myqsqliData['artist'];
    $this->albumId = $this->myqsqliData['album'];
    $this->genre = $this->myqsqliData['genre'];
    $this->duration = $this->myqsqliData['duration'];
    $this->path = $this->myqsqliData['path'];
  }
}