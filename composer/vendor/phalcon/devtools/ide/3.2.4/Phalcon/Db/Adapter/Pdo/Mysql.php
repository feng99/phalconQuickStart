<?php 

namespace Phalcon\Db\Adapter\Pdo {

	class Mysql extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_type;

		protected $_dialectType;

		public function describeColumns($table, $schema=null){ }


		public function describeIndexes($table, $schema=null){ }


		public function describeReferences($table, $schema=null){ }


		public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference){ }

	}
}
