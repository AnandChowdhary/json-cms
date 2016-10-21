<?php

    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
    }

    date_default_timezone_set("Asia/Kolkata");
    $GLOBALS["raw_data"] = file_get_contents("data.json");
    $GLOBALS["data"] = json_decode($GLOBALS["raw_data"]);
    
    class category {
        public $name;
        public $slug;
    }

    class post {
        public $title;
        public $slug;
        public $author;
        public $datetime;
        public $category;
        public $tags;
        public $visible;
        public $excerpt;
        public $body;
    }

    class author {
        public $name;
        public $slug;
        public $email;
        public $desc;
    }

    class page {
        public $title;
        public $slug;
        public $body;
    }

    class setting {
        public $name;
        public $slug;
        public $value;
    }

    $users = array(
        array("anand", "c35b26adc7e4199250a6eb49b2a33ac1", "sudo")
    );

    function updateData() {
        $updated_data = json_encode($GLOBALS["data"], true);
        $file = fopen("data.json", "w") or die("Unable to open file!");
        fwrite($file, $updated_data);
        fclose($file);
    }

    function getInfo($slug, $type) {
        switch($type) {
            case "category":
                $contents = $GLOBALS["data"]->categories;
                break;
            case "post":
                $contents = $GLOBALS["data"]->posts;
                break;
            case "author":
                $contents = $GLOBALS["data"]->authors;
                break;
            case "page":
                $contents = $GLOBALS["data"]->pages;
                break;
            case "setting":
                $contents = $GLOBALS["data"]->settings;
                break;
        }
        foreach ($contents as $content) {
            if ($content->slug == $slug) {
                return $content;
                break;
            }
        }
    }
    
    function create($content, $type = "category") {
        switch ($type) {
            case "category":
                $GLOBALS["data"]->categories[sizeof($GLOBALS["data"]->categories)] = $content;
                break;
            case "post":
                $GLOBALS["data"]->posts[sizeof($GLOBALS["data"]->posts)] = $content;
                break;
            case "author":
                $GLOBALS["data"]->authors[sizeof($GLOBALS["data"]->authors)] = $content;
                break;
            case "page":
                $GLOBALS["data"]->pages[sizeof($GLOBALS["data"]->pages)] = $content;
                break;
            case "setting":
                $GLOBALS["data"]->settings[sizeof($GLOBALS["data"]->settings)] = $content;
                break;
        }
        updateData();
    }

    function delete($slug, $type = "category") {
        switch ($type) {
            case "category":
                $contents = $GLOBALS["data"]->categories;
                break;
            case "post":
                $contents = $GLOBALS["data"]->posts;
                break;
            case "author":
                $contents = $GLOBALS["data"]->authors;
                break;
            case "page":
                $contents = $GLOBALS["data"]->pages;
                break;
            case "setting":
                $contents = $GLOBALS["data"]->settings;
                break;
        }
        $i = 0;
        foreach($contents as $content) {
            if ($content->slug == $slug)
                break;
            $i++;
        }
        array_splice($contents, $i, 1);
        var_dump($contents);
        switch ($type) {
            case "category":
                $GLOBALS["data"]->categories = $contents;
                break;
            case "post":
                $GLOBALS["data"]->posts = $contents;
                break;
            case "author":
                $GLOBALS["data"]->authors = $contents;
                break;
            case "page":
                $GLOBALS["data"]->pages = $contents;
                break;
            case "setting":
                $GLOBALS["data"]->settings = $contents;
                break;
        }
        updateData();
    }

    function head($title) {
        echo '<!DOCTYPE html><html lang=en><title>'.$title.'</title><meta charset=utf-8><meta content="IE=edge"http-equiv=X-UA-Compatible><meta content="width=device-width,initial-scale=1"name=viewport><link href=../bootstrap.css rel=stylesheet><body style="padding:70px 0 30px 0"><nav class="navbar navbar-default navbar-fixed-top"><div class=container><div class=navbar-header><button aria-controls=navbar aria-expanded=false class="collapsed navbar-toggle"data-target=#navbar data-toggle=collapse type=button><span class=sr-only>Toggle navigation</span> <span class=icon-bar></span><span class=icon-bar></span><span class=icon-bar></span></button><a class=navbar-brand href=index.php>Admin Dashboard</a></div><div class="collapse navbar-collapse"id=navbar><ul class="nav navbar-nav">';
        if ($title == "Posts") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=posts">Posts</a></li></li>';
        if ($title == "Categories") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=categories">Categories</a></li></li>';
        if ($title == "Authors") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=authors">Authors</a></li></li>';
        if ($title == "Pages") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=pages">Pages</a></li></li>';
        if ($title == "Media") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="media.php">Media</a></li></li>';
        if ($title == "Settings") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=settings">Settings</a></li></li>';
        echo '</ul> <ul class="nav navbar-nav navbar-right"> <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a> <ul class="dropdown-menu"> <li><a href="editor.php?file=data.json">JSON datafile</a></li><li><a href="../">Visit site</a></li><li><a href="logout.php">Log out</a></li></ul> </li></ul> </div></div></nav> <div class="container">';
    }

    function foot() {
        echo '</div><script src="../bootstrap.js"></script></body></html>';
    }

?>