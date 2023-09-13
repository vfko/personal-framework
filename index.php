<?php

require_once 'config/loader.php';

// session_start();
// if (!isset($_SESSION['user_logged_in']) && $_SERVER['REQUEST_URI'] != '/login') {
// 	header('Location:/login');
// }

$page = new App($_SERVER['REQUEST_URI']);
$template = $page->getTemplate();
$page_data = $page->getPagedata();
$template_data = $page->getTemplateData();



include_once 'page/header.php';
include_once $template;
include_once 'page/footer.php';