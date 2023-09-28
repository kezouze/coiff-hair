<?php
// les helpers doivent porter l'extension _helper.php mais sont appelés sans dans l'autoload
session_start();

function isConnected()
{
    // if (isset($_SESSION['pseudo']) || isset($_SESSION['id'])) {
    //     return true;
    // } else {
    //     return false;
    // }

    // beaucoup plus simple :
    return isset($_SESSION['pseudo']) || isset($_SESSION['id']);
}
