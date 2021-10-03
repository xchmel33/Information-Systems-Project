<?php

define('PATH_VIEW','App/View/');
define('PATH_MODEL','App/Model/');
define('PATH_CONTROLLER','App/Controller/');
define('PATH_TEMPLATE','App/View/Template/');
define("HEADER",'Template/header.php');
define("FOOTER",'Template/footer.php');


require 'App/router.php';
require 'App/Controller/controller.php';
require 'App/Model/model.php';