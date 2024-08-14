<?php

require_once __DIR__ . '/../vendor/autoload.php';

$db = useDB();
$sql = <<<SQL
INSERT INTO users (name, email, age, address, country, status) VALUES (
  'Sarah Wilson', 'sarah.wilson@example.com', 29, '456 Elm St, 23456, CA', 'USA', 'active'
)
SQL;

try {
    $db->execute($sql);
    echo "Done!\n";
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
