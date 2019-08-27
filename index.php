<?php
ini_set('display_errors', 1);
ini_set('error_reporting', -1);
if (!class_exists('Core')) {
	require_once 'core/Core.php';
}
$Core = new Core();

//
//if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){
//    return 'HEEEEEEELO';
//    if (!empty($_POST['action'])) {return 'HELLO';}
//}

$req = !empty($_REQUEST['q'])
	? trim($_REQUEST['q'])
	: '';
$data = [];
$data = [
    'action' => isset($_REQUEST['action']) ? $_REQUEST['action'] : '',
    'group' =>  isset($_REQUEST['group']) ? $_REQUEST['group'] : '',
    'id' => isset($_REQUEST['id']) ? $_REQUEST['id'] : '',
];

$Core->handleRequest($req,$data);