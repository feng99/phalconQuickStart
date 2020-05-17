<?php 

namespace Phalcon\Cache\Backend {

	class Xcache extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options=null){ }


		public function get($keyName, $lifetime=null){ }


		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		public function delete($keyName){ }


		public function queryKeys($prefix=null){ }


		public function exists($keyName=null, $lifetime=null){ }


		public function increment($keyName, $value=null){ }


		public function decrement($keyName, $value=null){ }


		public function flush(){ }

	}
}
