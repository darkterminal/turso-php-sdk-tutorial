<?php

use Darkterminal\TursoHttp\sadness\LibSQLBlueprint;
use Darkterminal\TursoHttp\sadness\LibSQLSchemaBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

$db = useDB();
$schemaBuilder = new LibSQLSchemaBuilder($db);

try {
  $schemaBuilder->create('contacts', function (LibSQLBlueprint $table) {
    $table->increments('id');
    $table->integer('user_id')->notNull();
    $table->string('contact_name')->notNull();
    $table->string('phone')->notNull();
    $table->foreignKey('user_id', 'id', 'users');
  })->execute();
  echo "Done!\n";
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
