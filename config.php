<?php

define('HTTPS_SERVER','https://www.stud.fit.vutbr.cz/~xchmel33/WEBBIDS/');
define('PATH_MODEL','App/Model/');
define('PATH_CONTROLLER','App/Controller/');
define('PATH_CORE','App/Core/');
define('PATH_TEMPLATE','App/View/Template/');
define('PATH_JAVASCRIPT','Data/Javascript/');
define('PATH_STYLESHEET','Data/Stylesheet/');
define('PATH_IMAGE','Data/Image/');

/** HEADER & FOOTER **/
define("HEADER",'header.php');
define("FOOTER",'footer.php');

/** DATABASE **/
define("DB_NAME",'iis_bids');
define("DB_USER",'root');
define("DB_PASSWORD",'');
define("DB_PORT",'');
define("DB_HOST",'localhost');

/** CORE RESOURCES **/
require PATH_CORE.'router.php';
require PATH_CORE.'controller.php';
require PATH_CORE.'database.php';
