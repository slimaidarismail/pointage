
<?php

session_start();
include("config.php");
session_destroy();

echo '<script>document.location.href="' . root . '"</script>';

?>