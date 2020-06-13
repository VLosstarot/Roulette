<?php

declare(strict_types=1);

namespace App\Helper;


use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\ForeignKeyConstraint;

final class MigrationHelper
{
    public static function existColumn(
        AbstractSchemaManager $schemaManager,
        string $tableName,
        string ...$columnNames
    ): bool {
        $existColumnNames = array_map(static function (Column $column) {
            return $column->getName();
        }, $schemaManager->listTableColumns($tableName));

        return count(array_intersect($existColumnNames, $columnNames)) === count($columnNames);
    }

    public static function existForeignKey(
        AbstractSchemaManager $schemaManager,
        string $tableName,
        string $keyName
    ): bool {
        $foreignKeys = array_map(static function (ForeignKeyConstraint $foreignKeyConstraint) {
            return $foreignKeyConstraint->getName();
        }, $schemaManager->listTableForeignKeys($tableName));

        return in_array($keyName, $foreignKeys, true);
    }
}
