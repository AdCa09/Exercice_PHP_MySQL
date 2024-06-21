<?php

function logged()
{
    session_start();

    if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {

        return true;

    } else {
        return false;
    }
}
?>