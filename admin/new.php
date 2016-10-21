<?php
    include "admin.php";
    if (isset($_POST["new"])) {
        switch ($_POST["new"]) {
            case "category":
                $name = $_POST["name"];
                $slug = $_POST["slug"];
                $cat1 = new category;
                $cat1->name = $name;
                $cat1->slug = $slug;
                create($cat1, $_GET["type"]);
                header("Location: content.php?type=categories");
                break;
            case "post":
                $generatedSlug = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_"), 0, 6);
                $generatedSlug .= "-";
                if (strlen($_POST["title"]) > 30) {
                    $generatedSlug .= str_replace(" ", "-", substr(strtolower($_POST["title"]), 0, 30));
                } else {
                    $generatedSlug .= str_replace(" ", "-", strtolower($_POST["title"]));
                }
                $post1 = new post;
                $post1->title = $_POST["title"];
                $post1->slug = $generatedSlug;
                $post1->tags = $_POST["tags"];
                $post1->author = $_POST["author"];
                $post1->datetime = $_POST["datetime"];
                $post1->body = $_POST["body"];
                $post1->excerpt = $_POST["excerpt"];
                $post1->category = $_POST["category"];
                if (isset($_POST["visible"])) {
                    $visible = "no";
                } else {
                    $visible = "yes";
                }
                $post1->visible = $visible;
                echo "<h1>$generatedSlug</h1>";
                create($post1, $_GET["type"]);
                header("Location: content.php?type=posts");
                break;
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
            <form method="post">
                <fieldset>
                    <legend>New <?php echo ucfirst($_GET["type"]); ?></legend>
                <?php
                    switch($_GET["type"]) {
                        case "category":
                            echo '<div class="form-group">
                                    <label for="name">Category Name:</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter category name">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Category Slug:</label>
                                    <input name="slug" type="text" class="form-control" id="slug" placeholder="Enter category slug">
                                </div>
                                <input type="hidden" name="new" value="category">
                                <input type="submit" class="btn btn-default" value="Create Category">';
                            break;
                        case "post":
                            echo '<div class="form-group">
                                    <label for="title">Post Title:</label>
                                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter post title">
                                </div>
                                <div class="form-group">
                                    <label for="author">Post Author:</label>
                                    <input name="author" type="text" class="form-control" id="author" placeholder="Enter post author">
                                </div>
                                <div class="form-group">
                                    <label for="category">Post Category:</label>
                                    <input name="category" type="text" class="form-control" id="category" placeholder="Enter post category">
                                </div>
                                <div class="form-group">
                                    <label for="tags">Post Tags:</label>
                                    <input name="tags" type="text" class="form-control" id="tags" placeholder="Enter post tags">
                                </div>
                                <div class="form-group">
                                    <label for="datetime">Posted on:</label>
                                    <input name="datetime" type="date" class="form-control" id="datetime" value="' . date("Y-m-d") . '">
                                </div>
                                <div class="form-group">
                                    <label for="excerpt">Excerpt:</label>
                                    <textarea name="excerpt" id="excerpt" class="form-control" placeholder="Enter post excerpt"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="body">Body:</label>
                                    <textarea name="body" id="body" class="form-control" placeholder="Enter post body"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                    <label><input name="visible" type="checkbox" value="no">Hide this post from the blog lists</label>
                                </div>
                                <input type="hidden" name="new" value="post">
                                <input type="submit" class="btn btn-default" value="Create Post">';
                            break;
                    }
                ?>
                </fieldset>
            </form>
        </div>

        <script src="../bootstrap.js"></script>

    </body>

</html>