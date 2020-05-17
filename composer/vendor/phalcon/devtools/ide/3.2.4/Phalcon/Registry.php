<?php 

namespace Phalcon {

	final class Registry implements \ArrayAccess, \Countable, \Iterator, \Traversable {

		protected $_data;

		final public function __construct(){ }


		final public function offsetExists($offset){ }


		final public function offsetGet($offset){ }


		final public function offsetSet($offset, $value){ }


		final public function offsetUnset($offset){ }


		final public function count(){ }


		final public function next(){ }


		final public function key(){ }


		final public function rewind(){ }


		public function valid(){ }


		public function current(){ }


		final public function __set($key, $value){ }


		final public function __get($key){ }


		final public function __isset($key){ }


		final public function __unset($key){ }

	}
}
