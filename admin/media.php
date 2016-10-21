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
            <table class="table table-striped" style="margin-top: 30px"> <thead> <tr> <th>#</th> <th>File Name</th> <th>File Type</th> <th>Delete File</th> <th>File Permalink</th></tr></thead> <tbody>
        <?php
            $dir = "../media/"; $i = 0;
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if ($file != "." && $file != "..") {
                            $i++;
                            $file_ext = strtoupper(pathinfo($file, PATHINFO_EXTENSION));
                            $file_types = array("AC97", "Audio Codec 97", "DivX", "Named as a paradoy to DIVX system (a video rental system)", "Codec", "Coder-Decoder", "FLAC", "Free Lossless Audio Codec", "AAC", "Advanced Audio Coding", "VBR", "Variable Bit Rate", "xACT", "X Audio Compression Toolkit", "MPEG", "Moving Picture Experts Group", "OSS", "Open Sound System", "ASI", "Asynchronous Serial Interface", "AMR", "Adaptive Multi-Rate", "DVI", "Digital Video Interactive", "CBR", "Constant Bitrate", "CCE", "Cinema Craft Encoder", "JAD", "Java Application Descriptor", "JPEG", "Joint Photographic Experts Group", "PDF", "Portable Document Format", "PNG", "Portable Network Graphics", "QIF", "Quicken Interchange Format", "TIFF", "Tagged Image File Format", "WMA", "Windows Media Audio", "WMV", "Windows Media Video", "JPG", "Joint Photographic Experts Group (JPEG)", "MP3", "MPEG Audio Layer III", "CSV", "The comma-separated values", "GIF", "The Graphics Interchange Format", "AVI", "Audio Video Interleave", "SWP", "Swap File", "MP4", "MPEG-4 AVC (Advanced Video Coding)", "FLV", "Flash Video", "MKV", "Matroska Video", "COD", "Compiled Source Code", "mpg", "Short for  MPEG (Motion Picture Experts Group)", "DVI", "DeVice-Independent", "ppt", "PowerPoint Presentation", "RAR", "Roshal ARchive", "Ogg", "Ogg derives from ogging, jargon from the computer game Netrek", "EPS", "Encapsulated PostScript", "PSD", "Photoshop Document", "MSI", "Microsoft Installer", "VOB", "Video Object", "EXE", "Executable", "AIFF", "Audio Interchange File Format", "ASF", "Advanced Systems Format ", "WAV", "Waveform Audio File Format", "ISO", "ISO image file format", "SIS", "Software Installation Script", "IRF", "Intrasis Raw File", "3GP", "3GPP file format", "RAW", "RAW file format", "SWF", "Shockwave Flash", "DWG", "Drawing", "XLS", "Microsoft Excel Spreadsheet", "DMG", "Disk Image", "ABS", "Abscissa Data File", "JAR", "Java ARchive", "DOC", "Document", "EFX", "Electronic Fax", "TXT", "Plain Text");
                            $file_type = $file_ext . " File";
                            if (in_array($file_ext, $file_types)) {
                                for ($j = 0; $j < count($file_types); $j++) {
                                    if ($file_types[$j] == $file_ext) {
                                        $file_type = $file_types[$j + 1];
                                    }
                                }
                            }
                            echo "<tr>
                                    <td>$i</td>
                                    <td>$file</td>
                                    <td>$file_type</td>
                                    <td><a href='delete.php?slug=$file&type=file'>Delete</a></td>
                                    <td><a target='_blank' href='../media/$file'>File URL</a></td>
                                </tr>";
                        }
                    }
                }
                closedir($dh);
            }
        ?>
            </tbody></table>