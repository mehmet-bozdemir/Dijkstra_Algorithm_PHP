<?php
require_once 'UTIL_Warehouse.php';

use Senior\UTIL_Warehouse;


$test = new UTIL_Warehouse();

var_dump($test->shortestPaths('A', 'E'));