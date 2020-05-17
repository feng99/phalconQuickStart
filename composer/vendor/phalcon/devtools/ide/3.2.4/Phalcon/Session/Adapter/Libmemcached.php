<?php 

namespace Phalcon\Session\Adapter {

	class Libmemcached extends \Phalcon\Session\Adapter implements \Phalcon\Session\AdapterInterface {

		const SESSION_ACTIVE = 2;

		const SESSION_NONE = 1;

		const SESSION_DISABLED = 0;

		protected $_libmemcached;

		protected $_lifetime;

		public function getLibmemcached(){ }


		public function getLifetime(){ }


		public function __construct($options){ }


		public function open(){ }


		public function close(){ }


		public function read($sessionId){ }


		public function write($sessionId, $data){ }


		public function destroy($sessionId=null){ }


		public function gc(){ }

	}
}
