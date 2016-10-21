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
        array("Anand Chowdhary", "anand", "c35b26adc7e4199250a6eb49b2a33ac1", "sudo")
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
        echo '<!DOCTYPE html><html lang=en><head><title>'.$title.'</title><meta charset=utf-8><meta content="IE=edge"http-equiv=X-UA-Compatible><meta content="width=device-width,initial-scale=1"name=viewport><link href=../bootstrap.css rel=stylesheet><script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script></head><body style="padding:70px 0 30px 0"><nav class="navbar navbar-default navbar-fixed-top"><div class=container><div class=navbar-header><button aria-controls=navbar aria-expanded=false class="collapsed navbar-toggle"data-target=#navbar data-toggle=collapse type=button><span class=sr-only>Toggle navigation</span> <span class=icon-bar></span><span class=icon-bar></span><span class=icon-bar></span></button><a class=navbar-brand href=index.php>Admin Dashboard</a></div><div class="collapse navbar-collapse"id=navbar><ul class="nav navbar-nav">';
        if ($title == "Posts") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=posts">Posts</a></li></li>';
        if ($title == "Categories") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=categories">Categories</a></li></li>';
        if ($title == "Authors") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=authors">Authors</a></li></li>';
        if ($title == "Pages") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=pages">Pages</a></li></li>';
        if ($title == "Media") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="media.php">Media</a></li></li>';
        if ($title == "Settings") { echo "<li class='active'>"; } else { echo "<li>"; } echo '<a href="content.php?type=settings">Settings</a></li></li>';
        echo '</ul> <ul class="nav navbar-nav navbar-right"> <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION["admin"].' <span class="caret"></span></a> <ul class="dropdown-menu"><li><a href="../">Visit Website</a></li><li role="separator" class="divider"><li class="dropdown-header">Advanced</li><li><a href="editor.php">File Manager</a></li><li><a href="editor.php?file=data.json">JSON Datafile</a></li><li role="separator" class="divider"></li><li><a href="logout.php">Users</a></li><li><a href="logout.php">Edit Password</a></li><li><a href="logout.php">Log out</a></li></ul> </li></ul> </div></div></nav> <div class="container">';
    }

    function foot() {
        echo '</div><script src="../bootstrap.js"></script></body></html>';
    }

    function human_filesize($bytes, $decimals = 2) {
        $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    $GLOBALS["file_types"] = array("AC97", "Audio Codec 97", "DivX", "Named as a paradoy to DIVX system (a video rental system)", "Codec", "Coder-Decoder", "FLAC", "Free Lossless Audio Codec", "AAC", "Advanced Audio Coding", "VBR", "Variable Bit Rate", "xACT", "X Audio Compression Toolkit", "MPEG", "Moving Picture Experts Group", "OSS", "Open Sound System", "ASI", "Asynchronous Serial Interface", "AMR", "Adaptive Multi-Rate", "DVI", "Digital Video Interactive", "CBR", "Constant Bitrate", "CCE", "Cinema Craft Encoder", "JAD", "Java Application Descriptor", "JPEG", "Joint Photographic Experts Group", "PDF", "Portable Document Format", "PNG", "Portable Network Graphics", "QIF", "Quicken Interchange Format", "TIFF", "Tagged Image File Format", "WMA", "Windows Media Audio", "WMV", "Windows Media Video", "JPG", "Joint Photographic Experts Group (JPEG)", "MP3", "MPEG Audio Layer III", "CSV", "The comma-separated values", "GIF", "The Graphics Interchange Format", "AVI", "Audio Video Interleave", "SWP", "Swap File", "MP4", "MPEG-4 AVC (Advanced Video Coding)", "FLV", "Flash Video", "MKV", "Matroska Video", "COD", "Compiled Source Code", "mpg", "Short for  MPEG (Motion Picture Experts Group)", "DVI", "DeVice-Independent", "ppt", "PowerPoint Presentation", "RAR", "Roshal ARchive", "Ogg", "Ogg derives from ogging, jargon from the computer game Netrek", "EPS", "Encapsulated PostScript", "PSD", "Photoshop Document", "MSI", "Microsoft Installer", "VOB", "Video Object", "EXE", "Executable", "AIFF", "Audio Interchange File Format", "ASF", "Advanced Systems Format ", "WAV", "Waveform Audio File Format", "ISO", "ISO image file format", "SIS", "Software Installation Script", "IRF", "Intrasis Raw File", "3GP", "3GPP file format", "RAW", "RAW file format", "SWF", "Shockwave Flash", "DWG", "Drawing", "XLS", "Microsoft Excel Spreadsheet", "DMG", "Disk Image", "ABS", "Abscissa Data File", "JAR", "Java ARchive", "DOC", "Document", "EFX", "Electronic Fax", "TXT", "Plain Text", "PHP", "PHP: Hypertext Preprocessor", "JSON", "JavaScript Object Notation");

?>