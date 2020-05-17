<?php 

namespace Phalcon\Cache\Backend {

	class Memcache extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		protected $_memcache;

		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options=null){ }


		public function _connect(){ }


		public function addServers($host, $port, $persistent=null){ }


		public function get($keyName, $lifetime=null){ }


		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		public function delete($keyName){ }


		public function queryKeys($prefix=null){ }


		public function exists($keyName=null, $lifetime=null){ }


		public function increment($keyName=null, $value=null){ }


		public function decrement($keyName=null, $value=null){ }


		public function flush(){ }

	}
}
