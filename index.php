
<?php
require_once('functions.php');
require_once('data.php');



error_reporting(E_ALL);
ini_set('display_errors', '1') . '<br>';



$sortColumn = isset($_GET['sort']) ? key($_GET['sort']) : 'city';
$sortOrder = isset($_GET['sort'][$sortColumn]) && $_GET['sort'][$sortColumn] === 'asc' ? 'asc' : 'desc';


// Сортування за вказаним порядком
usort($arr, 'multiLevelSort');



// Підключення файлу table.php для відображення таблиці
require_once('table.php');


?>


