<?php 

namespace Phalcon\Mvc\Model\Query {

	class Status implements \Phalcon\Mvc\Model\Query\StatusInterface {

		protected $_success;

		protected $_model;

		public function __construct($success, \Phalcon\Mvc\ModelInterface $model=null){ }


		public function getModel(){ }


		public function getMessages(){ }


		public function success(){ }

	}
}
