<?php

require_once __DIR__ . '/../vendor/autoload.php';

$db = useDB();
$sql =<<<SQL
CREATE TABLE IF NOT EXISTS "users" (
  id INTEGER PRIMARY KEY,
  name TEXT NOT NULL, 
  email TEXT NOT NULL,
  age INTEGER NOT NULL, 
  address TEXT,
  country TEXT NOT NULL, 
  status TEXT NOT NULL
);
SQL;

try {
    $db->execute($sql);
    echo "Done!\n";
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
