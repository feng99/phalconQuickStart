<?php 

namespace Phalcon\Cache {

	class Multiple {

		protected $_backends;

		public function __construct($backends=null){ }


		public function push(\Phalcon\Cache\BackendInterface $backend){ }


		public function get($keyName, $lifetime=null){ }


		public function start($keyName, $lifetime=null){ }


		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		public function delete($keyName){ }


		public function exists($keyName=null, $lifetime=null){ }


		public function flush(){ }

	}
}
