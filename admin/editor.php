<?php
    include "admin.php";
    if (isset($_POST["editor_data"])) {
        $file = fopen($_GET["file"], "w") or die("Unable to open file!");
        fwrite($file, $_POST["editor_data"]);
        fclose($file);
        header("Location: editor.php?file=" . $_GET["file"]);
    }
    if (isset($_POST["new_file"])) {
        touch($_POST["new_file"]);
        header("Location: editor.php");
    }
    if (isset($_GET["file"])) { head("File Editor");
?>
            <h1>File Editor</h1>
            <p>Only make changes if you know what you're doing. Any wrong code can break your website completely.</p>
            <form method="post" style="margin-top: 20px">
                <input class="form-control" value="<?php echo $_GET['file']; ?>" disabled>
                <textarea style="margin-top: 20px" name="editor_data" rows="10" class="form-control"><?php echo file_get_contents($_GET["file"]); ?></textarea>
                <input style="margin-top: 20px" type="submit" class="btn btn-primary" value="Save File">
            </form>
<?php } else { head("File Manager"); ?>
<h1>File Manager</h1>
<form method="post"><div class="row" style="margin-bottom: 30px; margin-top: 30px"> <div class="col-md-6"><input name="new_file" type="text" class="form-control" value="Enter new file name"> </div> <div class="col-md-6"><input type="submit" value="Create New File" class="btn btn-default"></div> </div></form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>File Name</th>
            <th>File Type</th>
            <th>File Size</th>
            <th>Edit File</th>
            <th>Delete File</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $dir = "."; $i = 0;
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
                                    <td>".human_filesize(filesize($file))."</td>
                                    <td><a href='editor.php?file=$file'>Edit File</a></td>
                                    <td><a href='delete.php?slug=$file&type=filemgr'>Delete File</a></td>
                                </tr>";
                        }
                    }
                }
                closedir($dh);
            }
    ?>
    </tbody>
</table>
<?php } foot(); ?>