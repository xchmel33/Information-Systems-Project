<?php

/** PATH **/
define('PATH_MODEL','App/Model/');
define('PATH_CONTROLLER','App/Controller/');
define('PATH_CORE','App/Core/');
define('PATH_TEMPLATE','App/View/Template/');
define('PATH_JAVASCRIPT','App/View/Javascript/');
define('PATH_STYLESHEET','App/View/Stylesheet/');

/** HEADER & FOOTER **/
define("HEADER",'header.php');
define("FOOTER",'footer.php');

/** DATABASE **/
define("DB_NAME",'IIS_BIDS');
define("DB_USER",'root');
define("DB_PASSWORD",'');
define("DB_HOST",'localhost');

/** CORE RESOURCES **/
require PATH_CORE.'router.php';
require PATH_CORE.'controller.php';
require PATH_CORE.'database.php';