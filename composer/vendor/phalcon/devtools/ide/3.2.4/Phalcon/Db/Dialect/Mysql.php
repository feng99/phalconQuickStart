<?php 

namespace Phalcon\Db\Dialect {

	class Mysql extends \Phalcon\Db\Dialect implements \Phalcon\Db\DialectInterface {

		protected $_escapeChar;

		public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column){ }


		public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column){ }


		public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn=null){ }


		public function dropColumn($tableName, $schemaName, $columnName){ }


		public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index){ }


		public function dropIndex($tableName, $schemaName, $indexName){ }


		public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index){ }


		public function dropPrimaryKey($tableName, $schemaName){ }


		public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference){ }


		public function dropForeignKey($tableName, $schemaName, $referenceName){ }


		public function createTable($tableName, $schemaName, $definition){ }


		public function truncateTable($tableName, $schemaName){ }


		public function dropTable($tableName, $schemaName=null, $ifExists=null){ }


		public function createView($viewName, $definition, $schemaName=null){ }


		public function dropView($viewName, $schemaName=null, $ifExists=null){ }


		public function tableExists($tableName, $schemaName=null){ }


		public function viewExists($viewName, $schemaName=null){ }


		public function describeColumns($table, $schema=null){ }


		public function listTables($schemaName=null){ }


		public function listViews($schemaName=null){ }


		public function describeIndexes($table, $schema=null){ }


		public function describeReferences($table, $schema=null){ }


		public function tableOptions($table, $schema=null){ }


		protected function _getTableOptions($definition){ }


		public function getForeignKeyChecks(){ }

	}
}
