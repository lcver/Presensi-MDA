<?php
/**
 * Base URL
 * @return URL
 */
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
$base_url.= "://".$_SERVER['HTTP_HOST'];
$base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),'',$_SERVER['SCRIPT_NAME']);
define('BASEURL', $base_url);

/**
 * Start Session
 * 
 * @start Session
 */
session_start();


$app_path = realpath(dirname(__FILE__));
$app_path = str_replace("\\",'/',$app_path);
// $app_path = str_replace($_SERVER['DOCUMENT_ROOT'],'',$app_path);
$app_path = preg_replace('/config/', '', $app_path);
$app_path = str_replace("App/",'',$app_path);
define('BASEPATH',$app_path);

// db
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', 'Lucver1092');
define('DBNAME', 'db_presensi_ppg');