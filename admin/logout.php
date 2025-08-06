<?php
session_start();
session_destroy();
header("Location: /pos-kontraktor/index.php");
exit;
