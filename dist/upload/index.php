<?php
$folder       = 'files/';
$file         = basename($_FILES['file']['name']);
$max_filesize = 1024 * 1024 * 20;
$size         = filesize($_FILES['file']['tmp_name']);
$extensions   = array('.png', '.gif', '.jpg', '.jpeg');
$extension    = strrchr($_FILES['file']['name'], '.');

$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . "/upload/files";

//Starting security checks
if (!in_array($extension, $extensions)) {
    //If the extension is not in the array
    $error = 'Upload is restricted to png, gif, jpg, jpeg, txt or doc...';
}
if ($size > $max_filesize) {
    $error = 'Filesize is over the max filesize defined...';
}

if (!isset($error)) {
    //No error, uploading
    //Name reformating
    $file = strtr($file,
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $folder . $file)) {
        //if true, upload has started
        print json_encode(["filename" => $actual_link . "/" . $file]);
    } else {
        print json_encode('Upload has failed.');
    }
} else {
    print json_encode($error);
}
?>

