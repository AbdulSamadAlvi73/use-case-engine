<?php
// $conn = mysqli_connect('localhost', 'root', '', 'use_case_engine');
require("../Admin/conn.php");

session_start();
session_unset();
session_destroy();
header('location:../index.php');
?>