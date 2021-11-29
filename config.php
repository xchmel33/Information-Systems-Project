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
define("DB_NAME",'xchmel33');
define("DB_USER",'xchmel33');
define("DB_PASSWORD",'4tisomju');
define("DB_PORT",'/var/run/mysql/mysql.sock');
define("DB_HOST",'localhost');

/** CORE RESOURCES **/
require PATH_CORE.'router.php';
require PATH_CORE.'controller.php';
require PATH_CORE.'database.php';
