<?php 

namespace Phalcon\Db {

	abstract class Adapter implements \Phalcon\Db\AdapterInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_eventsManager;

		protected $_descriptor;

		protected $_dialectType;

		protected $_type;

		protected $_dialect;

		protected $_connectionId;

		protected $_sqlStatement;

		protected $_sqlVariables;

		protected $_sqlBindTypes;

		protected $_transactionLevel;

		protected $_transactionsWithSavepoints;

		protected static $_connectionConsecutive;

		public function getDialectType(){ }


		public function getType(){ }


		public function getSqlVariables(){ }


		public function __construct($descriptor){ }


		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getEventsManager(){ }


		public function setDialect(\Phalcon\Db\DialectInterface $dialect){ }


		public function getDialect(){ }


		public function fetchOne($sqlQuery, $fetchMode=null, $bindParams=null, $bindTypes=null){ }


		public function fetchAll($sqlQuery, $fetchMode=null, $bindParams=null, $bindTypes=null){ }


		public function fetchColumn($sqlQuery, $placeholders=null, $column=null){ }


		public function insert($table, $values, $fields=null, $dataTypes=null){ }


		public function insertAsDict($table, $data, $dataTypes=null){ }


		public function update($table, $fields, $values, $whereCondition=null, $dataTypes=null){ }


		public function updateAsDict($table, $data, $whereCondition=null, $dataTypes=null){ }


		public function delete($table, $whereCondition=null, $placeholders=null, $dataTypes=null){ }


		public function escapeIdentifier($identifier){ }


		public function getColumnList($columnList){ }


		public function limit($sqlQuery, $number){ }


		public function tableExists($tableName, $schemaName=null){ }


		public function viewExists($viewName, $schemaName=null){ }


		public function forUpdate($sqlQuery){ }


		public function sharedLock($sqlQuery){ }


		public function createTable($tableName, $schemaName, $definition){ }


		public function dropTable($tableName, $schemaName=null, $ifExists=null){ }


		public function createView($viewName, $definition, $schemaName=null){ }


		public function dropView($viewName, $schemaName=null, $ifExists=null){ }


		public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column){ }


		public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn=null){ }


		public function dropColumn($tableName, $schemaName, $columnName){ }


		public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index){ }


		public function dropIndex($tableName, $schemaName, $indexName){ }


		public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index){ }


		public function dropPrimaryKey($tableName, $schemaName){ }


		public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference){ }


		public function dropForeignKey($tableName, $schemaName, $referenceName){ }


		public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column){ }


		public function listTables($schemaName=null){ }


		public function listViews($schemaName=null){ }


		public function describeIndexes($table, $schema=null){ }


		public function describeReferences($table, $schema=null){ }


		public function tableOptions($tableName, $schemaName=null){ }


		public function createSavepoint($name){ }


		public function releaseSavepoint($name){ }


		public function rollbackSavepoint($name){ }


		public function setNestedTransactionsWithSavepoints($nestedTransactionsWithSavepoints){ }


		public function isNestedTransactionsWithSavepoints(){ }


		public function getNestedTransactionSavepointName(){ }


		public function getDefaultIdValue(){ }


		public function getDefaultValue(){ }


		public function supportSequences(){ }


		public function useExplicitIdValue(){ }


		public function getDescriptor(){ }


		public function getConnectionId(){ }


		public function getSQLStatement(){ }


		public function getRealSQLStatement(){ }


		public function getSQLBindTypes(){ }

	}
}
