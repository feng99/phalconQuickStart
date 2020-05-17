<?php 

namespace Phalcon\Cache\Backend {

	class File extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		private $_useSafeKey;

		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options){ }


		public function get($keyName, $lifetime=null){ }


		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		public function delete($keyName){ }


		public function queryKeys($prefix=null){ }


		public function exists($keyName=null, $lifetime=null){ }


		public function increment($keyName=null, $value=null){ }


		public function decrement($keyName=null, $value=null){ }


		public function flush(){ }


		public function getKey($key){ }


		public function useSafeKey($useSafeKey){ }

	}
}
