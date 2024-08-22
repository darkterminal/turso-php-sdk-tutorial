<?php

require_once __DIR__ . '/../vendor/autoload.php';

$builder = useQueryBuilder();
// SELECT id, name, age FROM users WHERE age > 30
$users = $builder->table('users')
    ->select('id, name, age')
    ->where('age', '>', 30)
    ->get();

foreach ($users as $user) {
    echo "ID: {$user['id']}, Name: {$user['name']} ({$user['age']})\n";
}
