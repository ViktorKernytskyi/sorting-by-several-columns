<?php
require_once('functions.php');

if (!isset($arr)) {
    include('data.php');
}

//$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'city';
//$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';
//
//// Сортування за вказаною колонкою та порядком
//$arr = sortData($arr, $sortColumn, $sortOrder);




?>
<!DOCTYPE html>
<html>
<head>
    <title>Table Sort</title>
</head>
<body>
<h3>Таблиця продуктів</h3>
<table border="1">
    <thead>
    <tr>
        <?php foreach (['city', 'name', 'country', 'price'] as $col) : ?>
            <th>
                <a href="?<?= buildSortUrl($sorts, $col) ?>">
                    <?= ucfirst($col) ?>
                </a>
            </th>
        <?php endforeach; ?>
    </tr>

    </thead>
    <tbody>
    <?php foreach ($arr as $item) : ?>
        <tr>
            <td><?= $item['city']; ?></td>
            <td><?= $item['name']; ?></td>
            <td><?= $item['country']; ?></td>
            <td><?= $item['price']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>






