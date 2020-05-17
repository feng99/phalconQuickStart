<?php 

namespace Phalcon {

	class Loader implements \Phalcon\Events\EventsAwareInterface {

		protected $_eventsManager;

		protected $_foundPath;

		protected $_checkedPath;

		protected $_classes;

		protected $_extensions;

		protected $_namespaces;

		protected $_directories;

		protected $_files;

		protected $_registered;

		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getEventsManager(){ }


		public function setExtensions($extensions){ }


		public function getExtensions(){ }


		public function registerNamespaces($namespaces, $merge=null){ }


		protected function prepareNamespace($namespace){ }


		public function getNamespaces(){ }


		public function registerDirs($directories, $merge=null){ }


		public function getDirs(){ }


		public function registerFiles($files, $merge=null){ }


		public function getFiles(){ }


		public function registerClasses($classes, $merge=null){ }


		public function getClasses(){ }


		public function register($prepend=null){ }


		public function unregister(){ }


		public function loadFiles(){ }


		public function autoLoad($className){ }


		public function getFoundPath(){ }


		public function getCheckedPath(){ }

	}
}
