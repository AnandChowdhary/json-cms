<?php
    $GLOBALS["data"] = json_decode(file_get_contents("admin/data.json"));
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
    if (isset($_GET["content"])) {
        $content = $_GET["content"];
    } else {
        $content = "home";
    }
    if (isset($_GET["type"])) {
        $type = $_GET["type"];
    } else {
        $type = "page";
    }
?><!doctype html>
<html>
    <head>
        <title><?php echo getInfo("site-title", "setting")->value; ?></title>
        <meta name="twitter:title" content="Made with Love in India">
        <meta property="og:title" content="Made with Love in India">
        <meta property="og:site_name" content="<?php echo getInfo("site-title", "setting")->value; ?>">
        <meta name="generator" content="JSONCMS v0.9">
    </head>
    <body>
        <header id="masthead">
            <div class="container">
                <nav class="navbar">
                    <ul class="nav">
                        <li><a href="?">Home</a></li>
                        <li><a href="?content=about&type=page">About us</a></li>
                        <li><a href="?content=contact&type=page">Contact us</a></li>
                        <li><a href="?content=blog&type=page">Blog</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main id="content">
            <div class="container">
            <?php if ($content != "home") echo '<h1 class="page-title">' . getInfo($content, $type)->title . '</h1>'; ?>
                <div class="page-content">
                <?php
                    echo getInfo($content, $type)->body;
                    if ($content == "blog") {
                        echo "<ul>";
                        foreach($GLOBALS["data"]->posts as $post) {
                            echo "<li><strong>$post->title</strong><br>$post->author<br>$post->datetime<br>$post->category<br><br></li>";
                        }
                        echo "</ul>";
                    }
                ?>
                </div>
            </div>
        </main>
        <footer id="colophon">
            <div class="container">
                <p>&copy; <?php echo date("Y") . " " . getInfo("site-title", "setting")->value; ?></p>
            </div>
        </footer>
    </body>
</html>