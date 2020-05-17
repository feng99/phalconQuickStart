<?php 

namespace Phalcon\Session {

	class Bag implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Session\BagInterface, \IteratorAggregate, \Traversable, \ArrayAccess, \Countable {

		protected $_dependencyInjector;

		protected $_name;

		protected $_data;

		protected $_initialized;

		protected $_session;

		public function __construct($name){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function initialize(){ }


		public function destroy(){ }


		public function set($property, $value){ }


		public function __set($property, $value){ }


		public function get($property, $defaultValue=null){ }


		public function __get($property){ }


		public function has($property){ }


		public function __isset($property){ }


		public function remove($property){ }


		public function __unset($property){ }


		final public function count(){ }


		final public function getIterator(){ }


		final public function offsetSet($property, $value){ }


		final public function offsetExists($property){ }


		final public function offsetUnset($property){ }


		final public function offsetGet($property){ }

	}
}
