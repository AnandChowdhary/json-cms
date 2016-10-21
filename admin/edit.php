<?php
    include "admin.php";
    if (isset($_POST["edit"])) {
        delete($_POST["original_slug"], $_POST["edit"]);
        switch($_POST["edit"]) {
            case "category":
                $content = new category;
                $content->name = $_POST["name"];
                $content->slug = $_POST["slug"];
                create($content, $_POST["edit"]);
                header("Location: content.php?type=categories");
                break;
        }
    } else {
        $slug = $_GET["slug"];
        switch ($_GET["type"]) {
            case "category":
                $name = getInfo($slug, "category")->name;
        }
    }
?><!doctype html>
<html lang="en">

	<head>

        <title>Categories</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../bootstrap.css" rel="stylesheet">

    </head>

    <body style="padding: 70px 0 30px 0">

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Admin Dashboard</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="content.php?type=posts">Posts</a></li>
                        <li><a href="content.php?type=categories">Categories</a></li>
                        <li><a href="content.php?type=authors">Authors</a></li>
                        <li><a href="content.php?type=pages">Pages</a></li>
                        <li><a href="media.php">Media</a></li>
                        <li><a href="content.php?type=settings">Settings</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="editor.php?file=data.json">JSON datafile</a></li>
                                <li><a href="../">Visit site</a></li>
                                <li><a href="logout.php">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container"><form method="post">
                <fieldset>
                    <legend>New Category</legend>
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug">Category Slug:</label>
                        <input name="slug" type="text" class="form-control" id="slug" value="<?php echo $slug; ?>">
                    </div>
                    <input type="hidden" name="original_slug" value="<?php echo $slug; ?>">
                    <input type="hidden" name="edit" value="category">
                    <input type="submit" class="btn btn-default" value="Update Category">
                </fieldset>
            </form>
        </div>

        <script src="../bootstrap.js"></script>

    </body>

</html>