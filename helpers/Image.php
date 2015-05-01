<?php

namespace Helpers;

class Image
{
    public static function uploadImg($dest, $name)
    {
        if (!$_FILES['img']['error']) {
            # Générer un nom de fichier

            $file = $_FILES['img']['tmp_name'];
            if (!move_uploaded_file($file, $dest . $name)) {
                die("Il y a eu un problème");
            }

            # Redimensionnement
            $percent = 0.5;

            // Get new dimensions
            list($width, $height) = getimagesize($dest . $name);
            $new_width = $width * $percent;
            $new_height = $height * $percent;

            // Resample
            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($dest . $name);

            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            imagejpeg($image_p, $dest . '@2x-' . $name, 100);
        }
    }
} 