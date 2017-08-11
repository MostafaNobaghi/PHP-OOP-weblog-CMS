<?php

////////// Define separator
defined('DS')? NULL : define('DS', DIRECTORY_SEPARATOR);

////////// DEFINE YOUR SITE ROOT
define('SITE_ROOT', dirname(dirname(__DIR__)).DS);

// if an error occured in oploading and deleting files, define "SITE ROOT" LIKE BELOW.
//define('SITE_ROOT', 'C:'.DS.'xampp'.DS.'htdocs'.DS.'gallery4_(cms_finished)'.DS);




define('INCLUDE_PATH', SITE_ROOT.'admin'.DS.'include'.DS);
require_once('functions.php');
require_once('configs.php');
require_once('classes/database.php');
require_once('classes/db_object.php');
require_once('classes/post.php');
require_once('classes/photo.php');
require_once('classes/user.php');
require_once('classes/comment.php');
require_once('classes/category.php');
require_once('classes/junk.php');
require_once('classes/session.php');
require_once('classes/paginate.php');


