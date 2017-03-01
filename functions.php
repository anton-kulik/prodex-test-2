<?php

require_once 'settings.php';


function getAllImage()
{
    $connect = mysqli_connect(HOST, USER, PASS, DB_NAME) or die('Error database');
    $query = "SELECT `id`, `imageName` AS name, `small` FROM `images`";
    $allImages = mysqli_query($connect, $query);
    mysqli_close($connect);
    $data = array();
    while ($row = mysqli_fetch_assoc($allImages)) {
        $data[] = $row;
    }

    return $data;
}


function addImage($image)
{
    $error = null;

    $smImage = 'images/sm-' . $image ['name'];
    imageResize($smImage, $image['tmp_name'], 100, 100, 75);

    $path = 'images/' . $image['name'];
    move_uploaded_file($image['tmp_name'], $path);


    $connect = mysqli_connect(HOST, USER, PASS, DB_NAME) or die('Error database');
    $query = "INSERT INTO `images` SET `imageName` = '{$image['name']}', `small` = 'sm-{$image['name']}'";

    if (!mysqli_query($connect, $query)) {
        $error = 1;
    }

    mysqli_close($connect);

    if ($error === null) {
        return true;
    }

    return false;
}


function imageResize($outfile, $infile, $neww, $newh, $quality)
{
    $im = imagecreatefromjpeg($infile);
    $im1 = imagecreatetruecolor($neww, $newh);
    imagecopyresampled($im1, $im, 0, 0, 0, 0, $neww, $newh, imagesx($im), imagesy($im));

    imagejpeg($im1, $outfile, $quality);
    imagedestroy($im);
    imagedestroy($im1);
}


function delImage($id, $name)
{
    $id = intval($id);
    $connect = mysqli_connect(HOST, USER, PASS, DB_NAME) or die('Error database');
    $query = "DELETE FROM `images` WHERE `id` = {$id}";
    $result = mysqli_query($connect, $query);
    mysqli_close($connect);

    if(isset($name) && !empty($name))
    {
        unlink('images/' . $name);
        unlink('images/sm-' . $name);
    }

    if ($result === true) {
        return true;
    }

    return false;
}