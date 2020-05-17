<?php 

namespace Phalcon\Forms {

	class Form extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Countable, \Iterator, \Traversable {

		protected $_position;

		protected $_entity;

		protected $_options;

		protected $_data;

		protected $_elements;

		protected $_elementsIndexed;

		protected $_messages;

		protected $_action;

		protected $_validation;

		public function setValidation($validation){ }


		public function getValidation(){ }


		public function __construct($entity=null, $userOptions=null){ }


		public function setAction($action){ }


		public function getAction(){ }


		public function setUserOption($option, $value){ }


		public function getUserOption($option, $defaultValue=null){ }


		public function setUserOptions($options){ }


		public function getUserOptions(){ }


		public function setEntity($entity){ }


		public function getEntity(){ }


		public function getElements(){ }


		public function bind($data, $entity, $whitelist=null){ }


		public function isValid($data=null, $entity=null){ }


		public function getMessages($byItemName=null){ }


		public function getMessagesFor($name){ }


		public function hasMessagesFor($name){ }


		public function add(\Phalcon\Forms\ElementInterface $element, $position=null, $type=null){ }


		public function render($name, $attributes=null){ }


		public function get($name){ }


		public function label($name, $attributes=null){ }


		public function getLabel($name){ }


		public function getValue($name){ }


		public function has($name){ }


		public function remove($name){ }


		public function clear($fields=null){ }


		public function count(){ }


		public function rewind(){ }


		public function current(){ }


		public function key(){ }


		public function next(){ }


		public function valid(){ }

	}
}
