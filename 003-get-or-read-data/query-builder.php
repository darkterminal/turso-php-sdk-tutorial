<?php

require_once __DIR__ . '/../vendor/autoload.php';

$builder = useQueryBuilder();
// SELECT name, email FROM users
$users = $builder->table('users')->select('name, email')->get();
var_dump($users);
