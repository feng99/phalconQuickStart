<?php 

namespace Phalcon {

	class Validation extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\ValidationInterface {

		protected $_data;

		protected $_entity;

		protected $_validators;

		protected $_combinedFieldsValidators;

		protected $_filters;

		protected $_messages;

		protected $_defaultMessages;

		protected $_labels;

		protected $_values;

		public function getData(){ }


		public function setValidators($validators){ }


		public function __construct($validators=null){ }


		public function validate($data=null, $entity=null){ }


		public function add($field, \Phalcon\Validation\ValidatorInterface $validator){ }


		public function rule($field, \Phalcon\Validation\ValidatorInterface $validator){ }


		public function rules($field, $validators){ }


		public function setFilters($field, $filters){ }


		public function getFilters($field=null){ }


		public function getValidators(){ }


		public function setEntity($entity){ }


		public function getEntity(){ }


		public function setDefaultMessages($messages=null){ }


		public function getDefaultMessage($type){ }


		public function getMessages(){ }


		public function setLabels($labels){ }


		public function getLabel($field){ }


		public function appendMessage(\Phalcon\Validation\MessageInterface $message){ }


		public function bind($entity, $data){ }


		public function getValue($field){ }


		protected function preChecking($field, \Phalcon\Validation\ValidatorInterface $validator){ }

	}
}
