<?php 

namespace Phalcon\Mvc\Model {

	abstract class Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		protected $_options;

		protected $_messages;

		public function __construct($options){ }


		protected function appendMessage($message, $field=null, $type=null){ }


		public function getMessages(){ }


		public function getOptions(){ }


		public function getOption($option, $defaultValue=null){ }


		public function isSetOption($option){ }

	}
}
