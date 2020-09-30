<?php

class DisplayPhotos
{

   private $mysqli;

   public function __construct()
   {
      $this->mysqli = new mysqli('mysql48.mydevil.net', 'm1145_photolio', 'Bzyku130579', 'm1145_photolio');
      $this->mysqli->set_charset('utf8');
   }

   public function getPhotos($albumId)
   {
      $result = $this->mysqli->query("SELECT * FROM photos WHERE album_id='$albumId'");
      return ($this->mysqli->affected_rows > 0) ? $result : null;
   }
}

$album = new DisplayPhotos;
$photos = $album->getPhotos($_GET['albumId']);

if ($photos) {
   foreach ($photos as $photo) {
      echo '<div class="gallery-photo">';
      echo '<a href="../photos/' . $photo['user_id'] . '/' . $photo['id'] . '.jpg" data-lightbox="' . $photo['album_name'] . '" data-title="' . $photo['title'] . '">';
      echo '<img src="/photos/' . $photo['user_id'] . '/thumbnails/' . $photo['id'] . '.jpg" class="gallery" alt="' . $photo['title'] . '" loading="lazy">';
      echo '<div class="gallery-photo-overlay">';
      echo $photo->title ?? 'Album: ' . $photo['album_name'];
      echo '</div>';
      echo '</a>';
      echo '</div>';
   }
} else {
   echo '<h2 style="margin-top: 100px">Ten album nie zawiera zdjęć</h3>';
}
