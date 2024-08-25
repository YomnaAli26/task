<?php
function uploadImage($image, $folder,$disk='public')
{
    if ($image->isValid()) {
        $path = $image->storeAs('images/'.$folder, $image->hashName(),$disk);
        return $path;
    }
    return false;
}
