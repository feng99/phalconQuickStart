<?php 

namespace Phalcon\Mvc\Model\Transaction {

	class Failed extends \Phalcon\Mvc\Model\Transaction\Exception implements \Throwable {

		protected $_record;

		public function __construct($message, \Phalcon\Mvc\ModelInterface $record=null){ }


		public function getRecordMessages(){ }


		public function getRecord(){ }

	}
}
