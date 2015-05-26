<?php


namespace Components;


class Cache
{
    private static $buffer;

    /**
     * Créer un fichier de cache
     * @param $filename
     * @param $content
     * @return int
     */
    private static function write($filename, $content)
    {
        return file_put_contents('./tmp/' . $filename, $content);
    }

    /**
     * Récupère le contenu d'un fichier cache
     * @param $filename
     * @return bool|string
     */
    private static function read($filename)
    {
        $file = './tmp/' . $filename;
        if(!file_exists($file)){
            return false;
        }

        $lifetime = (time() - filemtime($file)) / 60;
        if($lifetime > 60) {
            return false;
        }
        return file_get_contents($file);
    }

    /**
     * "démarre le cache"
     * @param $cachename
     */
    public static function start($cachename)
    {
        if($content = self::read($cachename)) {
            echo $content;
            self::$buffer = false;
            return true;
        }
        ob_start();
        self::$buffer = $cachename;
    }

    /**
     * Arrête le cache
     */
    public static function end()
    {
        if(!self::$buffer){
            return false;
        }
        $content = ob_get_clean();
        echo $content;
        self::write(self::$buffer, $content);
    }
} 