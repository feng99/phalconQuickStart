<?php 

namespace Phalcon\Mvc\View {

	class Simple extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\ViewBaseInterface {

		protected $_options;

		protected $_viewsDir;

		protected $_partialsDir;

		protected $_viewParams;

		protected $_engines;

		protected $_registeredEngines;

		protected $_activeRenderPath;

		protected $_content;

		protected $_cache;

		protected $_cacheOptions;

		public function getRegisteredEngines(){ }


		public function __construct($options=null){ }


		public function setViewsDir($viewsDir){ }


		public function getViewsDir(){ }


		public function registerEngines($engines){ }


		protected function _loadTemplateEngines(){ }


		final protected function _internalRender($path, $params){ }


		public function render($path, $params=null){ }


		public function partial($partialPath, $params=null){ }


		public function setCacheOptions($options){ }


		public function getCacheOptions(){ }


		protected function _createCache(){ }


		public function getCache(){ }


		public function cache($options=null){ }


		public function setParamToView($key, $value){ }


		public function setVars($params, $merge=null){ }


		public function setVar($key, $value){ }


		public function getVar($key){ }


		public function getParamsToView(){ }


		public function setContent($content){ }


		public function getContent(){ }


		public function getActiveRenderPath(){ }


		public function __set($key, $value){ }


		public function __get($key){ }

	}
}
