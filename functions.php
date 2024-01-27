<?php
require_once('data.php');



// Функція для побудови URL для сортування
function buildSortUrl($currentSorts, $column)
{
    $sortOrder = 'asc';

    // Визначаємо напрямок сортування (asc або desc)
    if (isset($currentSorts[$column]) && $currentSorts[$column] === 'asc') {
        $sortOrder = 'desc';
    }

    // Побудова URL з новими параметрами сортування
    $urlParams = http_build_query(array_merge($_GET, ['sorts' => [$column => $sortOrder]]));

    return htmlentities($urlParams);
}

// Отримання поточного порядку сортування з параметрів URL
$sorts = [];
if (isset($_GET['sorts']) && is_array($_GET['sorts'])) {
    $sorts = $_GET['sorts'];
}

// functions.php

function sortArrayByColumns($arr, $sorts) {
    // Групування за містами і типами продуктів
    $groupedArray = [];
    foreach ($arr as $item) {
        $groupedArray[$item['city']][$item['name']][] = $item;
    }

    // Сортування для кожної групи
    foreach ($groupedArray as &$cityGroup) {
        foreach ($cityGroup as &$productTypeGroup) {
            usort($productTypeGroup, function ($a, $b) use ($sorts) {
                foreach ($sorts as $column => $order) {
                    $result = 0;

                    if ($column === 'price') {
                        $result = $a['price'] - $b['price'];
                    } else {
                        $result = strcmp($a[$column], $b[$column]);
                    }

                    if ($order === 'desc') {
                        $result *= -1;
                    }

                    if ($result !== 0) {
                        return $result;
                    }
                }

                return 0;
            });
        }
    }

    // Збірка та повернення результатів
    $resultArray = [];
    foreach ($groupedArray as $cityGroup) {
        foreach ($cityGroup as $productTypeGroup) {
            $resultArray = array_merge($resultArray, $productTypeGroup);
        }
    }

    return $resultArray;
}





?>




