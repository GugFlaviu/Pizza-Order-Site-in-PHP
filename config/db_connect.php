<?php
$con = mysqli_connect("localhost", "flaviu", "test1234", "pizza");
if (!$con) {
    echo "connection error" . mysqli_connect_error();
}
