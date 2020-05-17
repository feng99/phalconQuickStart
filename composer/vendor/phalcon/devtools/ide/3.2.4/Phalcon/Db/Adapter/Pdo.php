<?php 

namespace Phalcon\Db\Adapter {

	abstract class Pdo extends \Phalcon\Db\Adapter implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Db\AdapterInterface {

		protected $_pdo;

		protected $_affectedRows;

		public function __construct($descriptor){ }


		public function connect($descriptor=null){ }


		public function prepare($sqlStatement){ }


		public function executePrepared(\PDOStatement $statement, $placeholders, $dataTypes){ }


		public function query($sqlStatement, $bindParams=null, $bindTypes=null){ }


		public function execute($sqlStatement, $bindParams=null, $bindTypes=null){ }


		public function affectedRows(){ }


		public function close(){ }


		public function escapeString($str){ }


		public function convertBoundParams($sql, $params=null){ }


		public function lastInsertId($sequenceName=null){ }


		public function begin($nesting=null){ }


		public function rollback($nesting=null){ }


		public function commit($nesting=null){ }


		public function getTransactionLevel(){ }


		public function isUnderTransaction(){ }


		public function getInternalHandler(){ }


		public function getErrorInfo(){ }

	}
}
