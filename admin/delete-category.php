<?php
    include "admin.php";
    $delete = $_GET["slug"];
    deleteCategory($delete);
    header("Location: categories.php");
?>