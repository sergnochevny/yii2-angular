<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 09.10.2017
 * Time: 12:40
 */

namespace app\migrations;

use yii\db\Migration;

class BaseMigration extends Migration
{
    const PREFIX = '';

    public function createTable($table, $columns, $options = null)
    {
        $options = null;
        if ($this->db->driverName === 'mysql') {
            $options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        parent::createTable($table, $columns, $options);
    }

    /**
     * Creates foreign keys from array settings
     *
     * @param array $foreignKeys
     * @return void
     */
    protected function createForeignKeys(array $foreignKeys)
    {
        $p = self::PREFIX;
        foreach ($foreignKeys as $foreignKey => $refForeignKey) {
            list($table, $column) = explode('.', $foreignKey);
            list($refTable, $refColumn) = explode('.', $refForeignKey);

            $fkName = 'fk-' . $p . $table . '-' . $column;
            $this->addForeignKey(
                $fkName,
                $p . $table,
                $column,
                $p . $refTable,
                $refColumn,
                'RESTRICT',
                'RESTRICT'
            );
        }
    }

    /**
     * Drops foreign keys
     *
     * @param array $foreignKeys
     * @return void
     */
    protected function dropForeignKeys(array $foreignKeys)
    {
        $p = self::PREFIX;
        foreach ($foreignKeys as $foreignKey => $refForeignKey) {
            list($table, $column) = explode('.', $foreignKey);
            $fkName = 'fk-' . $p . $table . '-' . $column;
            $this->dropForeignKey($fkName, $p . $table);
        }
    }

    /**
     * Creates indexes from array settings
     *
     * @param array $indexes
     * @return void
     */
    protected function createIndexes(array $indexes)
    {
        $p = self::PREFIX;
        foreach ($indexes as $table => $columns) {
            foreach ($columns as $column) {
                $idxName = 'idx-' . $p . $table . '-' . $column;
                $this->createIndex($idxName, $p . $table, $column);
            }
        }
    }
}