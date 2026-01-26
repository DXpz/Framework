<?php

// Router script for PHP built-in server to support CodeIgniter routes

// Check if the requested file exists
if (file_exists(__DIR__ . '/public' . $_SERVER['REQUEST_URI'])) {
    // Serve the file directly
    return false;
}

// Rewrite to index.php
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';

// Set the path info
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path !== '/') {
    $_SERVER['PATH_INFO'] = $path;
}

// Include the CodeIgniter front controller
require __DIR__ . '/public/index.php';

