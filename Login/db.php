<?php

$con = mysqli_connect("localhost","root","","beer_game");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>