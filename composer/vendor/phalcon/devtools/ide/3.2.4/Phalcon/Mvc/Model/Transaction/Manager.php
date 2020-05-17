<?php 

namespace Phalcon\Mvc\Model\Transaction {

	class Manager implements \Phalcon\Mvc\Model\Transaction\ManagerInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_dependencyInjector;

		protected $_initialized;

		protected $_rollbackPendent;

		protected $_number;

		protected $_service;

		protected $_transactions;

		public function __construct(\Phalcon\DiInterface $dependencyInjector=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setDbService($service){ }


		public function getDbService(){ }


		public function setRollbackPendent($rollbackPendent){ }


		public function getRollbackPendent(){ }


		public function has(){ }


		public function get($autoBegin=null){ }


		public function getOrCreateTransaction($autoBegin=null){ }


		public function rollbackPendent(){ }


		public function commit(){ }


		public function rollback($collect=null){ }


		public function notifyRollback(\Phalcon\Mvc\Model\TransactionInterface $transaction){ }


		public function notifyCommit(\Phalcon\Mvc\Model\TransactionInterface $transaction){ }


		protected function _collectTransaction(\Phalcon\Mvc\Model\TransactionInterface $transaction){ }


		public function collectTransactions(){ }

	}
}
