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
                        <li class="active"><a href="categories.php">Categories</a></li>
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
            <h1>Categories <a href="new-category.php" class="btn btn-primary">Create New Category</a></h1>
            <table class="table table-striped" style="margin-top: 20px">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Category Slug</th>
                        <th>Post Count</th>
                        <th>Edit Category</th>
                        <th>Delete Category</th>
                        <th>Permalink</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Uncategorized</td>
                        <td>uncategorized</td>
                        <td>X</td>
                        <td>Uneditable</td>
                        <td>Undeletable</td>
                        <td><a target="_blank" href="../category/uncategorized">Link to category</a></li>
                    </tr>
                <?php
                    $raw_data = file_get_contents("data.json");
                    $data1 = json_decode($raw_data);
                    $i = 1;
                    foreach($data1->categories as $category) {
                        $nP = substr_count($raw_data, '"' . $category->slug . '"') - 1;
                        $i++;
                        echo "<tr>
                            <td>$i</td>
                            <td>$category->name</td>
                            <td>$category->slug</td>
                            <td>$nP</td>                            
                            <td><a href='edit-category.php?slug=$category->slug'>Edit</a></td>
                            <td><a href='delete.php?slug=$category->slug&type=category'>Delete</a></td>
                            <td><a target='_blank' href='../category/$category->slug'>Link to category</a></td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>

        <script src="../bootstrap.js"></script>

    </body>

</html>