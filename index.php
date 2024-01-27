
<?php
require_once('functions.php');
require_once('data.php');



// Перевірка, чи є параметр сортування в URL
//$sorts = getSortParams();


// Функція для порівняння за кількома стовпцями
function multiSort($a, $b) {
    // Спочатку сортуємо за city
    $city = strcmp($a['city'], $b['city']);
// Якщо city однакові, сортуємо за name
    if ($city === 0) {
        // Спочатку сортуємо за name
        $name = strcmp($a['name'], $b['name']);
//
//        if ($nameComparison === 0) {
//            $countryComparison = strcmp($a['country'], $b['country']);
// Якщо name однаковий, сортуємо за price
            if ($name === 0) {
                return ($a['price'] < $b['price']) ? -1 : 1;
            }
            return $name;
        }
        return $city;
    }
// Застосовуємо сортування за кількома стовпцями
usort($arr, 'multiSort');

// Виводимо результат
//print_r($arr);


//// Витягуємо значення стовпців в окремі масиви
//$cities = array_column($arr, 'city');
//$names = array_column($arr, 'name');
//$prices = array_column($arr, 'price');
//
//// Сортуємо всі масиви разом за містом, ім'ям і ціною
//array_multisort($cities, $names, $prices, $arr);

// Виводимо результат
//print_r($arr);


// Отримання поточного порядку сортування з параметрів URL
$sorts = [];
if (isset($_GET['sorts']) && is_array($_GET['sorts'])) {
    $sorts = $_GET['sorts'];
}

// Сортування масиву перед виведенням в таблицю
$arr = sortArrayByColumns($arr, $sorts);


// Підключення файлу table.php для відображення таблиці
require_once('table.php');


?>


