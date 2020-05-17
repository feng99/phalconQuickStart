<?php 

namespace Phalcon\Mvc\Model {

	class ValidationFailed extends \Phalcon\Mvc\Model\Exception implements \Throwable {

		protected $_model;

		protected $_messages;

		public function __construct(\Phalcon\Mvc\Model $model, $validationMessages){ }


		public function getModel(){ }


		public function getMessages(){ }

	}
}
