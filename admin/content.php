<?php include "admin.php"; ?><!doctype html>
<html lang="en">

	<head>

        <title><?php echo ucfirst($_GET["type"]); ?></title>
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
                        <li<?php if ($_GET["type"] == "posts") echo " class='active'"; ?>><a href="content.php?type=posts">Posts</a></li>
                        <li<?php if ($_GET["type"] == "categories") echo " class='active'"; ?>><a href="content.php?type=categories">Categories</a></li>
                        <li<?php if ($_GET["type"] == "authors") echo " class='active'"; ?>><a href="content.php?type=authors">Authors</a></li>
                        <li<?php if ($_GET["type"] == "pages") echo " class='active'"; ?>><a href="content.php?type=pages">Pages</a></li>
                        <li><a href="media.php">Media</a></li>
                        <li<?php if ($_GET["type"] == "settings") echo " class='active'"; ?>><a href="content.php?type=settings">Settings</a></li>
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
            <h1><?php echo ucfirst($_GET["type"]); ?> <?php
                switch ($_GET["type"]) {
                    case "categories":
                        echo '<a href="new.php?type=category" class="btn btn-primary">Create New Category</a></h1>';
                        echo '<table class="table table-striped" style="margin-top: 20px"> <thead> <tr> <th>#</th> <th>Category Name</th> <th>Category Slug</th> <th>Post Count</th> <th>Edit Category</th> <th>Delete Category</th> <th>Permalink</th> </tr></thead> <tbody> <tr> <td>1</td><td>Uncategorized</td><td>uncategorized</td><td>X</td><td>Uneditable</td><td>Undeletable</td><td><a target="_blank" href="../category/uncategorized">Link to category</a></li></tr>';
                        $i = 1;
                        foreach($GLOBALS["data"]->categories as $category) {
                            $nP = substr_count($GLOBALS["raw_data"], '"category":"' . $category->slug . '"');
                            $i++;
                            echo "<tr>
                                <td>$i</td>
                                <td>$category->name</td>
                                <td>$category->slug</td>
                                <td>$nP</td>                            
                                <td><a href='edit.php?slug=$category->slug&type=category'>Edit</a></td>
                                <td><a href='delete.php?slug=$category->slug&type=category'>Delete</a></td>
                                <td><a target='_blank' href='../category/$category->slug'>Link to category</a></td>
                            </tr>";
                        }
                        break;
                    case "posts":
                        echo '<a href="new.php?type=post" class="btn btn-primary">Create New Post</a></h1>';
                        echo '<table class="table table-striped" style="margin-top: 20px"> <thead> <tr> <th>#</th> <th>Title</th> <th>Author</th> <th>Posted on</th> <th>Category</th> <th>Tags</th> <th>Edit Post</th> <th>Delete Post</th> <th>Permalink</th> </tr></thead> <tbody>';
                        $i = 0;
                        foreach($GLOBALS["data"]->posts as $post) {
                            $i++; $visible = "";
                            if ($post->visible == "no") {
                                $visible = " (hidden)";
                            }
                            echo "<tr>
                                <td>$i</td>
                                <td>$post->title" . $visible . "</td>
                                <td>$post->author</td>
                                <td>$post->datetime</td>
                                <td>$post->category</td>
                                <td>$post->tags</td>
                                <td><a href='edit.php?slug=$post->slug&type=post'>Edit</a></td>
                                <td><a href='delete.php?slug=$post->slug&type=post'>Delete</a></td>
                                <td><a target='_blank' href='../$post->slug'>Link to post</a></td>
                            </tr>";
                        }
                        break;
                    case "authors":
                        echo '<a href="new.php?type=author" class="btn btn-primary">Create New Author</a></h1>';
                        break;
                    case "pages":
                        echo '<a href="new.php?type=page" class="btn btn-primary">Create New Page</a></h1>';
                        break;
                    case "settings":
                        echo '<a href="new.php?type=setting" class="btn btn-primary">Create New Setting</a></h1>';
                        break;
                }
            ?>
                </tbody>
            </table>
        </div>

        <script src="../bootstrap.js"></script>

    </body>

</html>