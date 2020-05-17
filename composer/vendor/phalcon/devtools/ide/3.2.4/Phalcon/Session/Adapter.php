<?php 

namespace Phalcon\Session {

	abstract class Adapter implements \Phalcon\Session\AdapterInterface {

		const SESSION_ACTIVE = 2;

		const SESSION_NONE = 1;

		const SESSION_DISABLED = 0;

		protected $_uniqueId;

		protected $_started;

		protected $_options;

		public function __construct($options=null){ }


		public function start(){ }


		public function setOptions($options){ }


		public function getOptions(){ }


		public function setName($name){ }


		public function getName(){ }


		public function regenerateId($deleteOldSession=null){ }


		public function get($index, $defaultValue=null, $remove=null){ }


		public function set($index, $value){ }


		public function has($index){ }


		public function remove($index){ }


		public function getId(){ }


		public function setId($id){ }


		public function isStarted(){ }


		public function destroy($removeData=null){ }


		public function status(){ }


		public function __get($index){ }


		public function __set($index, $value){ }


		public function __isset($index){ }


		public function __unset($index){ }


		public function __destruct(){ }


		protected function removeSessionData(){ }

	}
}
