<?php
    include "admin.php";
    if ($_GET["type"] == "file") {
        unlink("../media/" . $_GET["slug"]);
    } else if ($_GET["type"] == "filemgr") {
        unlink($_GET["slug"]);
    } else {
        delete($_GET["slug"], $_GET["type"]);
    }
    switch ($_GET["type"]) {
        case "category":
            header("Location: content.php?type=categories");
            break;
        case "post":
            header("Location: content.php?type=posts");
            break;
        case "author":
            header("Location: content.php?type=authors");
            break;
        case "page":
            header("Location: content.php?type=pages");
            break;
        case "setting":
            header("Location: content.php?type=settings");
            break;
        case "file":
            header("Location: media.php");
            break;
        case "filemgr":
            header("Location: editor.php");
            break;
    }
?>