<?php

    $GLOBALS["data"] = json_decode(file_get_contents("data.json"));
    
    class category {
        public $name;
        public $slug;
    }
    
    function createCategory($content) {
        $GLOBALS["data"]->categories[sizeof($GLOBALS["data"]->categories)] = $content;
        $updated_data = json_encode($GLOBALS["data"], true);
        $file = fopen("data.json", "w") or die("Unable to open file!");
        fwrite($file, $updated_data);
        fclose($file);
    }

    function deleteCategory($slug) {
        $i = 0;
        foreach($GLOBALS["data"]->categories as $category) {
            if ($category->slug == $slug)
                break;
            $i++;
        }
        array_splice($GLOBALS["data"]->categories, $i, 1);
        $updated_data = json_encode($GLOBALS["data"], true);
        $file = fopen("data.json", "w") or die("Unable to open file!");
        fwrite($file, $updated_data);
        fclose($file);
    }

?>