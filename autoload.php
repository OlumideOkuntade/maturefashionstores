<?php
    spl_autoload_register(function($class){
        $path = __DIR__ . "/". str_replace("\\","/", $class).".php";
        $prefix = 'C:\xampp\htdocs\maturedFashion/';
        $pathWithoutPrefix = str_replace($prefix,"",$path);
        //print_r($pathWithoutPrefix);
        if(file_exists($pathWithoutPrefix)){
            require $pathWithoutPrefix;
        }

        $path = __DIR__ . "/../". str_replace("\\","/", $class).".php";
        $prefix = 'C:\xampp\htdocs\maturedFashion/';
        $pathWithoutPrefix = str_replace($prefix,"",$path);
        //print_r($pathWithoutPrefix);
        if(file_exists($pathWithoutPrefix)){
            require $pathWithoutPrefix;
        }

        $path = __DIR__ . "/../../". str_replace("\\","/", $class).".php";
        $prefix = 'C:\xampp\htdocs\maturedFashion/';
        $pathWithoutPrefix = str_replace($prefix,"",$path);
        //print_r($pathWithoutPrefix);
        if(file_exists($pathWithoutPrefix)){
            require $pathWithoutPrefix;
        }

    });
