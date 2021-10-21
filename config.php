<?php

define('PATH_VIEW','App/View/');
define('PATH_MODEL','App/Model/');
define('PATH_CONTROLLER','App/Controller/');
define('PATH_CORE','App/Controller/');
define('PATH_TEMPLATE','App/View/Template/');
define("HEADER",'Template/header.php');
define("FOOTER",'Template/footer.php');


require 'App/Core/router.php';
require 'App/Core/controller.php';
require 'App/Core/database.php';