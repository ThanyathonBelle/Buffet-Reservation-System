<?php
    $connect = mysqli_connect('localhost','S010WLHE','','buffet_project');

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
      }
?>