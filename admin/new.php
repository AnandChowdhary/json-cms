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
            case "author":
                $slug = str_replace(" ", "-", strtolower($_POST["name"]));
                $author1 = new author;
                $author1->name = $_POST["name"];
                $author1->email = $_POST["email"];
                $author1->desc = $_POST["desc"];
                $author1->slug = $slug;
                create($author1, $_GET["type"]);
                header("Location: content.php?type=authors");
                break;
            case "page":
                $slug = str_replace(" ", "-", strtolower($_POST["title"]));
                $page1 = new page;
                $page1->title = $_POST["title"];
                $page1->body = $_POST["body"];
                $page1->slug = $slug;
                create($page1, $_GET["type"]);
                header("Location: content.php?type=pages");
                break;
            case "setting":
                $slug = str_replace(" ", "-", strtolower($_POST["name"]));
                $setting1 = new setting;
                $setting1->name = $_POST["name"];
                $setting1->value = $_POST["value"];
                $setting1->slug = $slug;
                create($setting1, $_GET["type"]);
                header("Location: content.php?type=settings");
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
                            <a class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="editor.php?file=data.json">JSON datafile</a></li>
                                <li><a href="../">Visit site</a></li>
                                <li><a href="logout.php">Log out</a></li>
                            </ul>
                        </li>
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
                        case "author":
                            echo '<div class="form-group">
                                    <label for="name">Author Name:</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter author name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Author Email:</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter author email">
                                </div>
                                <div class="form-group">
                                    <label for="desc">Author Description:</label>
                                    <textarea name="desc" id="desc" class="form-control" placeholder="Enter author description"></textarea>
                                </div>
                                <input type="hidden" name="new" value="author">
                                <input type="submit" class="btn btn-default" value="Create Author">';
                            break;
                        case "page":
                            echo '<div class="form-group">
                                    <label for="title">Page Title:</label>
                                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter page title">
                                </div>
                                <div class="form-group">
                                    <label for="body">Body:</label>
                                    <textarea name="body" id="body" class="form-control" placeholder="Enter page body"></textarea>
                                </div>
                                <input type="hidden" name="new" value="page">
                                <input type="submit" class="btn btn-default" value="Create Page">';
                            break;
                        case "setting":
                            echo '<div class="form-group">
                                    <label for="name">Setting Name:</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter setting name">
                                </div>
                                <div class="form-group">
                                    <label for="value">Setting Value:</label>
                                    <input name="value" type="text" class="form-control" id="value" placeholder="Enter setting value">
                                </div>
                                <input type="hidden" name="new" value="setting">
                                <input type="submit" class="btn btn-default" value="Create Setting">';
                            break;
                    }
                ?>
                </fieldset>
            </form>
        </div>

        <script src="../bootstrap.js"></script>

    </body>

</html>