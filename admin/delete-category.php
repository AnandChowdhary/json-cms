<?php
    include "admin.php";
    $data = json_decode(file_get_contents("data.json"));
    $delete = $_GET["slug"];
    $i = 0;
    foreach($data->categories as $category) {
        if ($category->slug == $delete) {
            break;
        }
        $i++;
    }
    array_splice($data->categories, $i, 1);
    $updated_data = json_encode($data, true);
    $data_file = fopen("data.json", "w") or die("Unable to open file!");
    fwrite($data_file, $updated_data);
    fclose($data_file);
    header("Location: categories.php");
?>