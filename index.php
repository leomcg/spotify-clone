<?php include("includes/header.php"); ?>

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
                <a href='album.php?id=" . $row['id'] . "'> 
                    <img src='" . $row['artworkPath'] . "'>

                    <div class='gridViewInfo'>"
                      . $row['title'] . "<br><span> by $artistName </span> " .
                    "</div>
                </a>
            </div>";


  	}
	?>

</div>





<?php include("includes/footer.php"); ?>