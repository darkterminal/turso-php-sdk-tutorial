<?php

require_once __DIR__ . '/../vendor/autoload.php';

$builder = useQueryBuilder();
$builder->table('users')->insert([
  'name' => 'Imam Ali Mustofa',
  'email' => 'darkterminal@duck.com',
  'age' => 29,
  'address' => 'Punk Universe',
  'country' => 'INA',
  'status' => 'dancing'
]);
echo "Done!\n";
