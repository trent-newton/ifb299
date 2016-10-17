<?php

$con = mysqli_connect("127.0.0.1:3307", "root", "", "pinelands_ms");

if(mysqli_connect_errno($con)) {
    echo "Unable to connect to the server:" . mysqli_connect_error();
}
