<?php

session_start();

if(isset($_SESSION['username'])){
    echo 'Welcome' .$_SESSION['username'].'<br>';
    echo 'Your Category is '. $_SESSION['FavCat'].'<br>';

}
else{
    echo "Please Login Again";
}


?>