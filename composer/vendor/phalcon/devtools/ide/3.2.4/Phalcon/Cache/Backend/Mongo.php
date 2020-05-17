<?php 

namespace Phalcon\Cache\Backend {

	class Mongo extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		protected $_collection;

		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options=null){ }


		final protected function _getCollection(){ }


		public function get($keyName, $lifetime=null){ }


		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		public function delete($keyName){ }


		public function queryKeys($prefix=null){ }


		public function exists($keyName=null, $lifetime=null){ }


		public function gc(){ }


		public function increment($keyName, $value=null){ }


		public function decrement($keyName, $value=null){ }


		public function flush(){ }

	}
}
