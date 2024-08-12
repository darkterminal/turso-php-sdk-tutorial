<?php

require_once __DIR__ . '/../vendor/autoload.php';

$db = useDB();
$sql = <<<SQL
CREATE TABLE IF NOT EXISTS "contacts" (
  id INTEGER PRIMARY KEY,
  user_id INTEGER NOT NULL,
  contact_name TEXT NOT NULL,
  phone TEXT NOT NULL,

  FOREIGN KEY (user_id)
  REFERENCES users(id)
  ON UPDATE CASCADE
  ON DELETE CASCADE
);
SQL;

try {
    $db->execute($sql);
    echo "Done!\n";
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
