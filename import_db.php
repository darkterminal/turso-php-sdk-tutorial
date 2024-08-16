<?php

require_once __DIR__ . '/vendor/autoload.php';

useQueryBuilder()->dropAllTables();

$statements = array_map(function ($query) {
    return trim($query);
}, explode('--##', file_get_contents('db_sample.sql')));

foreach ($statements as $query) {
    useDB()->executeBatch([
        'PRAGMA foreign_keys=OFF',
        $query,
        'PRAGMA foreign_keys=ON'
    ]);
}
echo "DONE\n";
