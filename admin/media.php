<!doctype html>
<html lang="en">

	<head>

        <title>Media</title>
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
                        <li class="active"><a href="media.php">Media</a></li>
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
            <h1>Media</h1>
        </div>

        <script src="../bootstrap.js"></script>

    </body>

</html>