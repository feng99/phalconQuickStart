<?php 

namespace Phalcon\Mvc\Model {

	abstract class Resultset implements \Phalcon\Mvc\Model\ResultsetInterface, \Iterator, \Traversable, \SeekableIterator, \Countable, \ArrayAccess, \Serializable, \JsonSerializable {

		const TYPE_RESULT_FULL = 0;

		const TYPE_RESULT_PARTIAL = 1;

		const HYDRATE_RECORDS = 0;

		const HYDRATE_OBJECTS = 2;

		const HYDRATE_ARRAYS = 1;

		protected $_result;

		protected $_cache;

		protected $_isFresh;

		protected $_pointer;

		protected $_count;

		protected $_activeRow;

		protected $_rows;

		protected $_row;

		protected $_errorMessages;

		protected $_hydrateMode;

		public function __construct($result, \Phalcon\Cache\BackendInterface $cache=null){ }


		public function next(){ }


		public function valid(){ }


		public function key(){ }


		final public function rewind(){ }


		final public function seek($position){ }


		final public function count(){ }


		public function offsetExists($index){ }


		public function offsetGet($index){ }


		public function offsetSet($index, $value){ }


		public function offsetUnset($offset){ }


		public function getType(){ }


		public function getFirst(){ }


		public function getLast(){ }


		public function setIsFresh($isFresh){ }


		public function isFresh(){ }


		public function setHydrateMode($hydrateMode){ }


		public function getHydrateMode(){ }


		public function getCache(){ }


		public function getMessages(){ }


		public function update($data, \Closure $conditionCallback=null){ }


		public function delete(\Closure $conditionCallback=null){ }


		public function filter($filter){ }


		public function jsonSerialize(){ }

	}
}
