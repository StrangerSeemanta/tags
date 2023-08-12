<?php
// Updating available file list 
$savedTags = new DirectoryIterator('saved tags/');
foreach($savedTags as $fileinfo) {
        if (!$fileinfo -> isDot()) {
            $folderName = $fileinfo -> getFilename();
            $node = '<option value="'.$folderName.
            '">'.$folderName.
            '</option>';

        header("Content-Type: text/plain");
        header("Content-Length: " . strlen($node));
        echo $node;
        }
    }
?>