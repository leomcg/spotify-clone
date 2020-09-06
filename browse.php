<?php include("includes/includedFiles.php"); ?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">

	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");
    
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