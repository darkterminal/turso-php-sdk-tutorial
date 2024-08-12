<?php

use Darkterminal\TursoHttp\sadness\LibSQLBlueprint;
use Darkterminal\TursoHttp\sadness\LibSQLSchemaBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

$db = useDB();
$schemaBuilder = new LibSQLSchemaBuilder($db);

try {
  $schemaBuilder->create('users', function (LibSQLBlueprint $table) {
    $table->increments('id');
    $table->string('name')->notNull();
    $table->unique('email')->notNull();
    $table->integer('age')->notNull();
    $table->string('address');
    $table->string('country')->notNull();
    $table->string('status')->notNull();
  })->execute();
  echo "Done!\n";
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
