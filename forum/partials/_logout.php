<?php
session_start();
echo "Logging you out pls wait....";
session_destroy();
header("Location: /forum");
?>