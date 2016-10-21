<?php
    include "admin.php";
    $slug = $_GET["slug"];
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
            case "setting":
                $setting1 = new setting;
                $setting1->name = $_POST["name"];
                $setting1->value = $_POST["value"];
                $setting1->slug = $_POST["slug"];
                create($setting1, $_POST["edit"]);
                header("Location: content.php?type=settings");
                break;
            case "post":
                $post1 = new post;
                $post1->title = $_POST["title"];
                $post1->author = $_POST["author"];
                $post1->category = $_POST["category"];
                $post1->tags = $_POST["tags"];
                $post1->datetime = $_POST["datetime"];
                $post1->excerpt = $_POST["excerpt"];
                $post1->body = $_POST["body"];
                if (isset($_POST["visible"])) {
                    $visible = "no";
                } else {
                    $visible = "yes";
                }
                $post1->visible = $visible;
                create($post1, $_POST["edit"]);
                header("Location: content.php?type=posts");
                break;
            case "page":
                $page1 = new page;
                $page1->title = $_POST["title"];
                $page1->body = $_POST["body"];
                $page1->slug = $_POST["slug"];
                create($page1, $_POST["edit"]);
                header("Location: content.php?type=pages");
                break;
            case "author":
                $page1 = new author;
                $page1->name = $_POST["name"];
                $page1->email = $_POST["email"];
                $page1->slug = $_POST["slug"];
                $page1->desc = $_POST["desc"];
                create($page1, $_POST["edit"]);
                header("Location: content.php?type=authors");
                break;
        }
    } else {
        $slug = $_GET["slug"];
    }
    head("Edit");
?>

<?php if ($_GET["type"] == "category") { ?>
            <form method="post">
                <fieldset>
                    <legend>Edit Category</legend>
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?php echo getInfo($slug, "category")->name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug">Category Slug:</label>
                        <input name="slug" type="text" class="form-control" id="slug" value="<?php echo getInfo($slug, "category")->slug; ?>">
                    </div>
                    <input type="hidden" name="original_slug" value="<?php echo $slug; ?>">
                    <input type="hidden" name="edit" value="category">
                    <input type="submit" class="btn btn-default" value="Update Category">
                </fieldset>
            </form><?php } ?>

<?php if ($_GET["type"] == "post") { ?>
            <form method="post">
                <fieldset>
                    <legend>Edit Post</legend>
                    <div class="form-group">
                        <label for="title">Post Title:</label>
                        <input name="title" type="text" class="form-control" id="title" value="<?php echo getInfo($slug, "post")->title; ?>">
                    </div>
                    <div class="form-group">
                        <label for="author">Post Author:</label>
                        <input name="author" type="text" class="form-control" id="author" value="<?php echo getInfo($slug, "post")->author; ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Post Category:</label>
                        <input name="category" type="text" class="form-control" id="category" value="<?php echo getInfo($slug, "post")->category; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tags">Post Tags:</label>
                        <input name="tags" type="text" class="form-control" id="tags" value="<?php echo getInfo($slug, "post")->tags; ?>">
                    </div>
                    <div class="form-group">
                        <label for="value">Posted on:</label>
                        <input name="datetime" type="text" class="form-control" id="datetime" value="<?php echo getInfo($slug, "post")->datetime; ?>">
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Excerpt:</label>
                        <textarea name="excerpt" id="excerpt" class="form-control"><?php echo getInfo($slug, "post")->excerpt; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="body">Body:</label>
                        <textarea name="body" id="body" class="form-control"><?php echo getInfo($slug, "post")->body; ?></textarea>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                        <label><?php
                            if (getInfo($slug, "post")->visible == "yes") {
                                echo '<input name="visible" type="checkbox" value="no">';
                            } else {
                                echo '<input name="visible" type="checkbox" value="no" checked>';
                            }
                        ?>Hide this post from the blog lists</label>
                    </div>
                    <input type="hidden" name="original_slug" value="<?php echo $slug; ?>">
                    <input type="hidden" name="edit" value="post">
                    <input type="submit" class="btn btn-default" value="Update Post">
                </fieldset><script> CKEDITOR.replace("body"); </script>
            </form><?php } ?>

<?php if ($_GET["type"] == "setting") { ?>
            <form method="post">
                <fieldset>
                    <legend>Edit Setting</legend>
                    <div class="form-group">
                        <label for="name">Setting Name:</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?php echo getInfo($slug, "setting")->name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug">Setting Slug:</label>
                        <input name="slug" type="text" class="form-control" id="slug" value="<?php echo getInfo($slug, "setting")->slug; ?>">
                    </div>
                    <div class="form-group">
                        <label for="value">Setting Value:</label>
                        <input name="value" type="text" class="form-control" id="value" value="<?php echo getInfo($slug, "setting")->value; ?>">
                    </div>
                    <input type="hidden" name="original_slug" value="<?php echo $slug; ?>">
                    <input type="hidden" name="edit" value="setting">
                    <input type="submit" class="btn btn-default" value="Update Setting">
                </fieldset>
            </form><?php } ?>

<?php if ($_GET["type"] == "author") { ?>
            <form method="post">
                <fieldset>
                    <legend>Edit Author</legend>
                    <div class="form-group">
                        <label for="name">Author</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?php echo getInfo($slug, "author")->name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug">Author Slug:</label>
                        <input name="slug" type="text" class="form-control" id="slug" value="<?php echo getInfo($slug, "author")->slug; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Author Email:</label>
                        <input name="email" type="email" class="form-control" id="email" value="<?php echo getInfo($slug, "author")->email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="body">Author Description:</label>
                        <textarea name="desc" type="text" class="form-control" id="body"><?php echo getInfo($slug, "author")->desc; ?></textarea>
                    </div>
                    <input type="hidden" name="original_slug" value="<?php echo $slug; ?>">
                    <input type="hidden" name="edit" value="author">
                    <input type="submit" class="btn btn-default" value="Update Author">
                </fieldset><script> CKEDITOR.replace("body"); </script>
            </form><?php } ?>

<?php if ($_GET["type"] == "page") { ?>
            <form method="post">
                <fieldset>
                    <legend>Edit Page</legend>
                    <div class="form-group">
                        <label for="title">Page Title:</label>
                        <input name="title" type="text" class="form-control" id="title" value="<?php echo getInfo($slug, "page")->title; ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug">Page Slug:</label>
                        <input name="slug" type="text" class="form-control" id="slug" value="<?php echo getInfo($slug, "page")->slug; ?>">
                    </div>
                    <div class="form-group">
                        <label for="body">Page Body:</label>
                        <textarea name="body" type="text" class="form-control" id="body"><?php echo getInfo($slug, "page")->body; ?></textarea>
                    </div>
                    <input type="hidden" name="original_slug" value="<?php echo $slug; ?>">
                    <input type="hidden" name="edit" value="page">
                    <input type="submit" class="btn btn-default" value="Update Page">
                </fieldset>
                <script> CKEDITOR.replace("body"); </script>
            </form><?php } ?>
<?php foot(); ?>