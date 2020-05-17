<?php 

namespace Phalcon\Session\Adapter {

	class Redis extends \Phalcon\Session\Adapter implements \Phalcon\Session\AdapterInterface {

		const SESSION_ACTIVE = 2;

		const SESSION_NONE = 1;

		const SESSION_DISABLED = 0;

		protected $_redis;

		protected $_lifetime;

		public function getRedis(){ }


		public function getLifetime(){ }


		public function __construct($options=null){ }


		public function open(){ }


		public function close(){ }


		public function read($sessionId){ }


		public function write($sessionId, $data){ }


		public function destroy($sessionId=null){ }


		public function gc(){ }

	}
}
