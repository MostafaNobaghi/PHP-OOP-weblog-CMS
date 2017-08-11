<?php

//function __autoload($class) {
//    $class = strtolower($class);
//    $the_path = "includes/$class.php";
//    if(file_exists($the_path)){
//        require_once($the_path);
//    }  else {
//        die("the file name $the_path is not exist");
//    }
//}

function redirect($location){
    header("location: $location");
}

function qwe($text){
    echo "$text";
}
