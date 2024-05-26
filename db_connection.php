<?php
 $mysqli = new mysqli("localhost", "root", "", "library");

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
?>