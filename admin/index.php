<?php
    session_start();
    if (isset($_SESSION["admin"])) {
        header("Location: content.php?type=posts");
    }
    if (isset($_POST["username"])) {
        if ($_POST["username"] == "anand") {
            if ($_POST["password"] == "anand01") {
                $_SESSION["admin"] = "admin";
                header("Location: content.php?type=posts");   
            }
        }
    }
?><!doctype html>
<html lang="en">

	<head>

        <title>Log in</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../bootstrap.css" rel="stylesheet">

    </head>

    <body style="padding: 10vh 0">

        <div class="container">
            <div class="col-md-4 col-md-push-4">
                <form method="post">
                    <fieldset>
                        <legend>Log in</legend>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input name="username" type="text" class="form-control" id="username" placeholder="Enter your username" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password">
                        </div>
                        <input type="submit" value="Log in" class="btn btn-primary">
                    </fieldset>
                </form>
            </div>
        </div>

    </body>

</html>