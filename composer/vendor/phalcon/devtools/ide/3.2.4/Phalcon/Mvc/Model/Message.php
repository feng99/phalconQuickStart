<?php 

namespace Phalcon\Mvc\Model {

	class Message implements \Phalcon\Mvc\Model\MessageInterface {

		protected $_type;

		protected $_message;

		protected $_field;

		protected $_model;

		protected $_code;

		public function __construct($message, $field=null, $type=null, $model=null, $code=null){ }


		public function setType($type){ }


		public function getType(){ }


		public function setMessage($message){ }


		public function getMessage(){ }


		public function setField($field){ }


		public function getField(){ }


		public function setModel(\Phalcon\Mvc\ModelInterface $model){ }


		public function setCode($code){ }


		public function getModel(){ }


		public function getCode(){ }


		public function __toString(){ }


		public static function __set_state($message){ }

	}
}
