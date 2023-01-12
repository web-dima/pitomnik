<?php
error_reporting(0);
session_start();
unset($_SESSION["user"]);
header("Location: ../index.php");