<?php 

namespace Phalcon\Db\Adapter\Pdo {

	class Sqlite extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_type;

		protected $_dialectType;

		public function connect($descriptor=null){ }


		public function describeColumns($table, $schema=null){ }


		public function describeIndexes($table, $schema=null){ }


		public function describeReferences($table, $schema=null){ }


		public function useExplicitIdValue(){ }


		public function getDefaultValue(){ }

	}
}
