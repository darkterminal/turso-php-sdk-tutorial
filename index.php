<?php

require_once __DIR__ . '/vendor/autoload.php';

$builder = useQueryBuilder();
$builder->insert([
    'name' => 'Sarah Wilson',
    'email' => 'sarah.wilson@example.com',
    'age' => 29,
    'address' => '456 Elm St, 23456, CA',
    'state' => 'INA',
    'status' => 'active'
]);
