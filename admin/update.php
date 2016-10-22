<?php
    include "admin.php";
    $current_version = 0.82;
    head("Updates");
?>
<h1>Updates</h1>
<div class="jumbotron" style="margin-top: 30px">
    <?php
        $update_check = json_decode(file_get_contents("https://raw.githubusercontent.com/AnandChowdhary/json-cms/master/version.json"));
        $version = $update_check->version;
        if ($version == $current_version) {
            echo "<p style='margin-bottom: 0'>You are running the latest version ($version).</p>";
        } else {
            echo "<p style='margin-bottom: 0'><strong>Update Available:</strong> Version $version<br><br><a href='https://github.com/AnandChowdhary/json-cms/archive/master.zip'>Click here</a> to download the ZIP file. Then, extract it to your root folder to update this software.</p>";
        }
    ?>
</div>