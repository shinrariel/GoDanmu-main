<?php
    $time = time();
    if($_SERVER["REQUEST_METHOD"] != 'POST')
    {
        header("HTTP/1.1 405 METHOD NOT ALLOWED");
        exit();
    }
    $content = file_get_contents('php://input');
    $post    = (array)json_decode($content, false);
    //log功能不写了,回来慢慢搞 5：47
?>