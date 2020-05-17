<?php 

namespace Phalcon\Db\Result {

	class Pdo implements \Phalcon\Db\ResultInterface {

		protected $_connection;

		protected $_result;

		protected $_fetchMode;

		protected $_pdoStatement;

		protected $_sqlStatement;

		protected $_bindParams;

		protected $_bindTypes;

		protected $_rowCount;

		public function __construct(\Phalcon\Db\AdapterInterface $connection, \PDOStatement $result, $sqlStatement=null, $bindParams=null, $bindTypes=null){ }


		public function execute(){ }


		public function fetch($fetchStyle=null, $cursorOrientation=null, $cursorOffset=null){ }


		public function fetchArray(){ }


		public function fetchAll($fetchStyle=null, $fetchArgument=null, $ctorArgs=null){ }


		public function numRows(){ }


		public function dataSeek($number){ }


		public function setFetchMode($fetchMode, $colNoOrClassNameOrObject=null, $ctorargs=null){ }


		public function getInternalResult(){ }

	}
}
