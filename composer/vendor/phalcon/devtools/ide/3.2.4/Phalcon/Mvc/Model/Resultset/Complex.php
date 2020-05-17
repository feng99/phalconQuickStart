<?php 

namespace Phalcon\Mvc\Model\Resultset {

	class Complex extends \Phalcon\Mvc\Model\Resultset implements \JsonSerializable, \Serializable, \ArrayAccess, \Countable, \SeekableIterator, \Traversable, \Iterator, \Phalcon\Mvc\Model\ResultsetInterface {

		const TYPE_RESULT_FULL = 0;

		const TYPE_RESULT_PARTIAL = 1;

		const HYDRATE_RECORDS = 0;

		const HYDRATE_OBJECTS = 2;

		const HYDRATE_ARRAYS = 1;

		protected $_columnTypes;

		protected $_disableHydration;

		public function __construct($columnTypes, \Phalcon\Db\ResultInterface $result=null, \Phalcon\Cache\BackendInterface $cache=null){ }


		final public function current(){ }


		public function toArray(){ }


		public function serialize(){ }


		public function unserialize($data){ }

	}
}
