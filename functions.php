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