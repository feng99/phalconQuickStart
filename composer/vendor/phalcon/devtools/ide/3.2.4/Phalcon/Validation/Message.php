<?php 

namespace Phalcon\Validation {

	class Message implements \Phalcon\Validation\MessageInterface {

		protected $_type;

		protected $_message;

		protected $_field;

		protected $_code;

		public function __construct($message, $field=null, $type=null, $code=null){ }


		public function setType($type){ }


		public function getType(){ }


		public function setMessage($message){ }


		public function getMessage(){ }


		public function setField($field){ }


		public function getField(){ }


		public function setCode($code){ }


		public function getCode(){ }


		public function __toString(){ }


		public static function __set_state($message){ }

	}
}
