<?php 

namespace Phalcon\Mvc\Model\Resultset {

	class Simple extends \Phalcon\Mvc\Model\Resultset implements \JsonSerializable, \Serializable, \ArrayAccess, \Countable, \SeekableIterator, \Traversable, \Iterator, \Phalcon\Mvc\Model\ResultsetInterface {

		const TYPE_RESULT_FULL = 0;

		const TYPE_RESULT_PARTIAL = 1;

		const HYDRATE_RECORDS = 0;

		const HYDRATE_OBJECTS = 2;

		const HYDRATE_ARRAYS = 1;

		protected $_model;

		protected $_columnMap;

		protected $_keepSnapshots;

		public function __construct($columnMap, $model, $result, \Phalcon\Cache\BackendInterface $cache=null, $keepSnapshots=null){ }


		final public function current(){ }


		public function toArray($renameColumns=null){ }


		public function serialize(){ }


		public function unserialize($data){ }

	}
}
