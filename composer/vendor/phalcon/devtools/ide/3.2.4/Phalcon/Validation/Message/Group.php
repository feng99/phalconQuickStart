<?php 

namespace Phalcon\Validation\Message {

	class Group implements \Countable, \ArrayAccess, \Iterator, \Traversable {

		protected $_position;

		protected $_messages;

		public function __construct($messages=null){ }


		public function offsetGet($index){ }


		public function offsetSet($index, $message){ }


		public function offsetExists($index){ }


		public function offsetUnset($index){ }


		public function appendMessage(\Phalcon\Validation\MessageInterface $message){ }


		public function appendMessages($messages){ }


		public function filter($fieldName){ }


		public function count(){ }


		public function rewind(){ }


		public function current(){ }


		public function key(){ }


		public function next(){ }


		public function valid(){ }


		public static function __set_state($group){ }

	}
}
