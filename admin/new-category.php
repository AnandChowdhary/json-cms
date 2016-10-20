<?php include "admin.php"; ?><!doctype html>
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
                        <li><a href="index.php">Summary</a></li>
                        <li><a href="posts.php">Posts</a></li>
                        <li><a href="categories.php">Categories</a></li>
                        <li><a href="authors.php">Authors</a></li>
                        <li><a href="pages.php">Pages</a></li>
                        <li><a href="media.php">Media</a></li>
                        <li><a href="settings.php">Settings</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"><strong>Create New...</strong> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="new-post.php">New Post</a></li>
                                <li><a href="new-author.php">New Author</a></li>
                                <li><a href="new-page.php">New Page</a></li>
                                <li><a href="new-category.php">New Category</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php">Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
        <?php
            if (isset($_POST["new"])) {
                $data = json_decode(file_get_contents("data.json"));
                $name = $_POST["name"];
                $slug = $_POST["slug"];
                class category {
                    public $name;
                    public $slug;
                }
                $cat1 = new category;
                $cat1->name = $name;
                $cat1->slug = $slug;
                $data->categories[sizeof($data->categories)] = $cat1;
                $updated_data = json_encode($data, true);
                $data_file = fopen("data.json", "w") or die("Unable to open file!");
                fwrite($data_file, $updated_data);
                fclose($data_file);
                echo "New category created successfully. <a href='categories.php'>Continue</a>";
            } else {
        ?>
            <form method="post">
                <fieldset>
                    <legend>New Category</legend>
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Enter category name">
                    </div>
                    <div class="form-group">
                        <label for="slug">Category Name:</label>
                        <input name="slug" type="text" class="form-control" id="slug" placeholder="Enter category slug">
                    </div>
                    <input type="hidden" name="new" value="category">
                    <input type="submit" class="btn btn-default" value="Create Category">
                </fieldset>
            </form>
        <?php
            }
        ?>
        </div>

        <script src="../bootstrap.js"></script>

    </body>

</html>