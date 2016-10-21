<?php
    include "admin.php";
    delete($_GET["slug"], $_GET["type"]);
    header("Location: content.php?type=categories");
?>