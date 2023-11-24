<?php 
/**
 * Primary script for asn1 implementation
 */
require_once "C:\wamp64\Assignment2\config\autoload.php";
use \Controller\Router;
$r = new Router(WEB_DIR);
$r->addRoute('login', '\Controller\LoginResponse->execute'); // Login.php
$r->addRoute('dashboard', '\Controller\DashboardResponse->execute'); //Dashboard.php
$r->addRoute('createuser', '\Controller\CreateUserResponse->execute'); // CreateUser.php
$r->addRoute('index', '\Controller\LoginResponse->execute'); // Login.php

$r->route();
?>