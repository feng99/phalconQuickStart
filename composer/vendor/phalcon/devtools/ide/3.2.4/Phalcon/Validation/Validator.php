<?php 

namespace Phalcon\Validation {

	abstract class Validator implements \Phalcon\Validation\ValidatorInterface {

		protected $_options;

		public function __construct($options=null){ }


		public function isSetOption($key){ }


		public function hasOption($key){ }


		public function getOption($key, $defaultValue=null){ }


		public function setOption($key, $value){ }


		abstract public function validate(\Phalcon\Validation $validation, $attribute);


		protected function prepareLabel(\Phalcon\Validation $validation, $field){ }


		protected function prepareMessage(\Phalcon\Validation $validation, $field, $type, $option=null){ }


		protected function prepareCode($field){ }

	}
}
