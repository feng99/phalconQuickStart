<?php 

namespace Phalcon\Db\Adapter\Pdo {

	class Postgresql extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_type;

		protected $_dialectType;

		public function connect($descriptor=null){ }


		public function describeColumns($table, $schema=null){ }


		public function createTable($tableName, $schemaName, $definition){ }


		public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn=null){ }


		public function useExplicitIdValue(){ }


		public function getDefaultIdValue(){ }


		public function supportSequences(){ }

	}
}
