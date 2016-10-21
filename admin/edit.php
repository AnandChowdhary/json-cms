<?php
    include "admin.php";
    if (isset($_POST["edit"])) {
        delete($_POST["original_slug"], $_POST["edit"]);
        switch($_POST["edit"]) {
            case "category":
                $content = new category;
                $content->name = $_POST["name"];
                $content->slug = $_POST["slug"];
                create($content, $_POST["edit"]);
                header("Location: content.php?type=categories");
                break;
        }
    } else {
        $slug = $_GET["slug"];
        switch ($_GET["type"]) {
            case "category":
                $name = getInfo($slug, "category")->name;
        }
    }
    head("Edit");
?><form method="post">
                <fieldset>
                    <legend>New Category</legend>
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug">Category Slug:</label>
                        <input name="slug" type="text" class="form-control" id="slug" value="<?php echo $slug; ?>">
                    </div>
                    <input type="hidden" name="original_slug" value="<?php echo $slug; ?>">
                    <input type="hidden" name="edit" value="category">
                    <input type="submit" class="btn btn-default" value="Update Category">
                </fieldset>
            </form>