<?php
$conn = mysqli_connect("localhost","root","","voter_db", 3307);
if(!$conn)
  {
    die("database connection failed");
  }
  else
    {
      echo "connection successed";
    }

?>