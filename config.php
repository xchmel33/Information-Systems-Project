<?php

/** PATH **/
define('PATH_VIEW','App/View/');
define('PATH_MODEL','App/Model/');
define('PATH_CONTROLLER','App/Controller/');
define('PATH_CORE','App/Core/');
define('PATH_TEMPLATE','App/View/Template/');

/** HEADER & FOOTER **/
define("HEADER",'Template/header.php');
define("FOOTER",'Template/footer.php');

/** DATABASE **/
define("DB_NAME",'IIS_BIDS');
define("DB_USER",'root');
define("DB_PASSWORD",'');
define("DB_HOST",'localhost');

/** CORE RESOURCES **/
require PATH_CORE.'router.php';
require PATH_CORE.'controller.php';
require PATH_CORE.'database.php';