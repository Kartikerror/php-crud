<?php

session_start();
$_SESSION['username'] = 'kartik';
$_SESSION['FavCat'] = 'Books';

echo "Session is started";

?>