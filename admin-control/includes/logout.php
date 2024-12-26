<?php
    // log out
    session_start();
    session_destroy();
    header("location: ../index.php");
?>