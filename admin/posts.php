<?php include "admin.php"; ?><!doctype html>
<html lang="en">

	<head>

        <title>Posts</title>
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
                        <li class="active"><a href="posts.php">Posts</a></li>
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
            <h1>Posts <a href="new-post.php" class="btn btn-primary">Create New Post</a></h1>
            <table class="table table-striped" style="margin-top: 20px">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Post Name</th>
                        <th>Post Slug</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Delete Post</th>
                        <th>Permalink</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $raw_data = file_get_contents("data.json");
                    $data = json_decode($raw_data);
                    $i = 1;
                    foreach($data->posts as $post) {
                        echo "<tr>
                            <td>$i</td>
                            <td>$post->title</td>
                            <td>$post->slug</td>
                            <td>$post->author</td>
                            <td>$post->category</td>
                            <td><a href='delete-post.php?slug=$post->slug'>Delete</a></td>
                            <td><a target='_blank' href='../$post->slug'>Link to post</a></td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>

        <script src="../bootstrap.js"></script>

    </body>

</html>