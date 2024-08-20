<?php

require_once __DIR__ . '/../vendor/autoload.php';

$builder = useQueryBuilder();
// SELECT DISTINCT name, email FROM users
$users = $builder->table('users')
    ->select('DISTINCT name, email')
    ->get();

foreach ($users as $user) {
    echo "Name: {$user['name']}, Email: {$user['email']}\n";
}
