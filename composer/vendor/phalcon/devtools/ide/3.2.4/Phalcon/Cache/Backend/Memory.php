<?php 

namespace Phalcon\Cache\Backend {

	class Memory extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface, \Serializable {

		protected $_data;

		public function get($keyName, $lifetime=null){ }


		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		public function delete($keyName){ }


		public function queryKeys($prefix=null){ }


		public function exists($keyName=null, $lifetime=null){ }


		public function increment($keyName=null, $value=null){ }


		public function decrement($keyName=null, $value=null){ }


		public function flush(){ }


		public function serialize(){ }


		public function unserialize($data){ }

	}
}
