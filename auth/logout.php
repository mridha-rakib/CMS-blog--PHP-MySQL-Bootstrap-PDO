<?php

session_start();
session_unset();
session_destroy();
header("location: http://localhost/Clean-Blog/index.php");