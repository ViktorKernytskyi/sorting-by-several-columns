
<?php
require_once('functions.php');
require_once('data.php');



// Перевірка, чи є параметр сортування в URL
//$sorts = getSortParams();


//// Функція для порівняння за кількома стовпцями
//function multiSort($a, $b) {
//    $cityComparison = strcmp($a['city'], $b['city']);
//
//    if ($cityComparison === 0) {
//        $nameComparison = strcmp($a['name'], $b['name']);
//
//        if ($nameComparison === 0) {
//            $countryComparison = strcmp($a['country'], $b['country']);
//
//            if ($countryComparison === 0) {
//                return ($a['price'] < $b['price']) ? -1 : 1;
//            }
//
//            return $countryComparison;
//        }
//
//        return $nameComparison;
//    }
//
//    return $cityComparison;
//}


// Перевірка, чи є параметр сортування в URL
$sorts = getSortParams();
var_dump($_GET);
//var_dump($arr);


//var_dump($sorts);

// Виведення таблиці
//echoTable($arr, $sorts);

// Функція для виведення таблиці
function echoTable($arr, $sorts)
{
    usort($arr, function ($a, $b) use ($sorts) {
        foreach ($sorts as $col => $order) {
            $result = strnatcasecmp($a[$col], $b[$col]);
            if ($result !== 0) {
                return ($order === 'asc') ? $result : -$result;
            }
        }
        return 0;
    });
}


// Підключення файлу table.php для відображення таблиці
require_once('table.php');


?>


