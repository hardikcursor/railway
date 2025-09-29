<?php

if (! function_exists('getImageExtension')) {
    function getImageExtension($base64Image)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
            return strtolower($matches[1]);
        }
        return 'jpg';
    }
}

function imageToBase64($path)
{
    if (! file_exists($path)) {
        return null;
    }
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    return 'data:image/' . $type . ';base64,' . base64_encode($data);
}
