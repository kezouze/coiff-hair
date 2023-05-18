<?php
// les helpers doivent porter l'extension _helper.php mais sont appelés sans dans l'autoload // 
session_start();

function isConnected()
{
    if (isset($_SESSION['pseudo'])) {
        return true;
    } else {
        return false;
    }
}
