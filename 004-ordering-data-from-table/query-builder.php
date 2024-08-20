<?php

require_once __DIR__ . '/../vendor/autoload.php';

$builder = useQueryBuilder();
// SELECT name, email FROM users ORDER BY name ASC
$users = $builder->table('users')
    ->select('name, email')
    ->orderBy('name', 'ASC')
    ->get();
var_dump($users);
