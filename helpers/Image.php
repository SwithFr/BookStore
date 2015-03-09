<?php


class Image 
{
    public static function uploadBookImg()
    {
        if(!$_FILES['img']['error']) {
            # Générer un nom de fichier
            $dest = D_ASSETS . DS . 'img' . DS . 'uploads' . DS . 'books' . DS . time() . pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
            var_dump($dest);die();
            $file = $_FILES['img']['tmp_name'];
            if(!@move_uploaded_file($file, './uploaded/' . $dest))
                die("Il y a eu un problème");

            # Redimensionnement
            $percent = 0.5;

            // Get new dimensions
            list($width, $height) = getimagesize('./uploaded/' . $dest);
            $new_width = $width * $percent;
            $new_height = $height * $percent;

            // Resample
            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg('./uploaded/' . $dest);

            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            imagejpeg($image_p,'./uploaded/resize/'.$dest,100);
        }
    }
} 