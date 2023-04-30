<?php
    //Open the session
    session_start();

    //If the session has a user_id value then echo it back
    if(isset($_SESSION["user_id"]))
    {
        echo $_SESSION["user_id"];
    }
    //If not, echo back none to indicate there is no logged in user
    else
    {
        echo "none";
    }