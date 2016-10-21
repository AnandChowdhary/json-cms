<?php
    include "admin.php";
    if (isset($_FILES["file"])) {
        echo "<h1>File uploaded!</h1>";
        $target_dir = "../media/";
        $generatedSlug = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_"), 0, 6);
        $generatedSlug .= "-";
        $target_file = $target_dir . $generatedSlug . basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            header("Location: media.php");
        }
    }
    head("Media");
?>
            <h1>Media</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="row" style="margin-top: 30px">
                    <div class="col-md-6"><input name="file" type="file" class="form-control" id="file"></div>
                    <div class="col-md-6"><input type="submit" value="Upload File" class="btn btn-primary"></div>
                </div>
            </form>
            <h2 style="margin-top: 30px">Your Files</h2>
            <table class="table table-striped" style="margin-top: 30px"> <thead> <tr> <th>#</th> <th>File Name</th> <th>File Type</th><th>File Size</th> <th>Delete File</th> <th>File Permalink</th></tr></thead> <tbody>
        <?php
            $dir = "../media/"; $i = 0;
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if ($file != "." && $file != "..") {
                            $i++;
                            $file_ext = strtoupper(pathinfo($file, PATHINFO_EXTENSION));
                            $file_type = $file_ext . " File";
                            if (in_array($file_ext, $GLOBALS["file_types"])) {
                                for ($j = 0; $j < count($file_types); $j++) {
                                    if ($GLOBALS["file_types"][$j] == $file_ext) {
                                        $file_type = $GLOBALS["file_types"][$j + 1];
                                    }
                                }
                            }
                            echo "<tr>
                                    <td>$i</td>
                                    <td>$file</td>
                                    <td>$file_type</td>
                                    <td>".human_filesize(filesize($dir.$file))."</td>
                                    <td><a href='delete.php?slug=$file&type=file'>Delete</a></td>
                                    <td><a target='_blank' href='../media/$file'>File URL</a></td>
                                </tr>";
                        }
                    }
                }
                closedir($dh);
            }
        ?>
            </tbody></table><?php foot(); ?>