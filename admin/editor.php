<?php
    include "admin.php";
    if (isset($_POST["editor_data"])) {
        $file = fopen($_GET["file"], "w") or die("Unable to open file!");
        fwrite($file, $_POST["editor_data"]);
        fclose($file);
        header("Location: editor.php?file=" . $_GET["file"]);
    }
    head("Editor");
?>
            <h1>Editor</h1>
            <p>Only make changes if you know what you're doing. Any wrong code can break your website completely.</p>
            <form method="post" style="margin-top: 20px">
                <input class="form-control" value="<?php echo $_GET['file']; ?>" disabled>
                <textarea style="margin-top: 20px" name="editor_data" rows="10" class="form-control"><?php echo file_get_contents($_GET["file"]); ?></textarea>
                <input style="margin-top: 20px" type="submit" class="btn btn-primary" value="Save File">
            </form>