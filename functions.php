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
//
//function sortArrayByColumns($arr, $sorts) {
//    // Групування за містами і типами продуктів
//    $groupedArray = [];
//    foreach ($arr as $item) {
//        $city = $item['city'];
//        $product = $item['name'];
//        $groupKey = $city . '_' . $product;
//
//        if (!isset($groupedArray[$groupKey])) {
//            $groupedArray[$groupKey] = [];
//        }
//
//        $groupedArray[$groupKey][] = $item;
//    }
//
//    // Збірка та повернення результатів
//    $resultArray = [];
//    foreach ($groupedArray as $productGroup) {
//        usort($productGroup, function ($a, $b) use ($sorts) {
//            $result = 0;
//            foreach ($sorts as $column => $order) {
//                if ($column === 'price') {
//                    $result = $a['price'] - $b['price'];
//                } elseif ($column === 'name') {
//                    $result = strcmp($a['name'], $b['name']);
//                } else {
//                    $result = strcmp($a[$column], $b[$column]);
//                }
//
//                if ($result !== 0) {
//                    return ($order === 'desc') ? -$result : $result;
//                }
//            }
//
//            return 0;
//        });
//
//        $resultArray = array_merge($resultArray, $productGroup);
//    }
//
//    return $resultArray;
//}

// functions.php
//
//function sortArrayByColumns($arr, $sorts) {
//    // Групування за містами і типами продуктів
//    $groupedArray = [];
//    foreach ($arr as $item) {
//        $city = $item['city'];
//        $product = $item['name'];
//        $groupKey = $city . '_' . $product;
//
//        if (!isset($groupedArray[$groupKey])) {
//            $groupedArray[$groupKey] = [];
//        }
//
//        $groupedArray[$groupKey][] = $item;
//    }
//
//    // Збірка та повернення результатів
//    $resultArray = [];
//    foreach ($groupedArray as $productGroup) {
//        usort($productGroup, function ($a, $b) use ($sorts) {
//            foreach ($sorts as $column => $order) {
//                $result = 0;
//
//                if ($column === 'price') {
//                    $result = $a['price'] - $b['price'];
//                } else {
//                    $result = strcmp($a[$column], $b[$column]);
//                }
//
//                if ($order === 'desc') {
//                    $result *= -1;
//                }
//
//                if ($result !== 0) {
//                    return $result;
//                }
//            }
//
//            return 0;
//        });
//
//        $resultArray = array_merge($resultArray, $productGroup);
//    }
//
//    return $resultArray;
//}



// Окрема функція для сортування за 'price'
function sortByPrice($a, $b) {
    return $a['price'] - $b['price'];
}

// Окрема функція для сортування за 'name'
function sortByName($a, $b) {
    return strnatcasecmp($a['name'], $b['name']);
}
// Основна функція для сортування
function sortArrayByColumns($arr, $sorts) {
    // Групування за 'city' та 'name'
    $groupedArray = [];
    foreach ($arr as $item) {
        $city = $item['city'];
        $product = $item['name'];
        $groupKey = $city . '_' . $product;

        if (!isset($groupedArray[$groupKey])) {
            $groupedArray[$groupKey] = [];
        }

        $groupedArray[$groupKey][] = $item;
    }

    // Збірка та повернення результатів
    $resultArray = [];

    foreach ($groupedArray as $productGroup) {
        // Сортування за 'city', 'name' та 'price' в межах групи
        usort($productGroup, function ($a, $b) use ($sorts) {
            $result = 0;

            foreach ($sorts as $column => $order) {
                if ($column === 'name') {
                    $result = strnatcasecmp($a['name'], $b['name']);
                } elseif ($column === 'price') {
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

        // Додаємо в результати групу після сортування
        $resultArray = array_merge($resultArray, $productGroup);
    }

    return $resultArray;
}





?>




