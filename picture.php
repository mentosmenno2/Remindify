<?php
/**
 * Created by PhpStorm.
 * User: Maarten
 * Date: 31-3-2015
 * Time: 12:14
 */

$data = array();

if(isset($_GET['files']))
{
    $error = false;
    $files = array();
    $direction = "";

    $uploaddir = 'uploads/';
    foreach($_FILES as $file)
    {
        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
        {
            $files[] = $uploaddir .$file['name'];
            $direction = $uploaddir .$file['name'];
        }
        else
        {
            $error = true;
        }
    }
    $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
}
else
{
    $data = array('success' => 'Picture was submitted', 'formData' => $_POST);
}

echo json_encode($data);

