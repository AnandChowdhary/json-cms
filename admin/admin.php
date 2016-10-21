<?php

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

    function updateData() {
        $updated_data = json_encode($GLOBALS["data"], true);
        $file = fopen("data.json", "w") or die("Unable to open file!");
        fwrite($file, $updated_data);
        fclose($file);
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

?>