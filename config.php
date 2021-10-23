<?php

/** PATH **/
define('PATH_VIEW','App/View/');
define('PATH_MODEL','App/Model/');
define('PATH_CONTROLLER','App/Controller/');
define('PATH_CORE','App/Controller/');
define('PATH_TEMPLATE','App/View/Template/');

/** HEADER & FOOTER **/
define("HEADER",'Template/header.php');
define("FOOTER",'Template/footer.php');

/** DATABASE **/
define("DB_NAME",'IIS_BIDS');
define("DB_USER",'root');
define("DB_PASSWORD",'');
define("DB_HOST",'localhost');

/** RESOURCES **/
require 'App/Core/router.php';
require 'App/Core/controller.php';
require 'App/Core/database.php';