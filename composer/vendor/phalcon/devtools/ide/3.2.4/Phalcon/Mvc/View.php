<?php 

namespace Phalcon\Mvc {

	class View extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\ViewInterface, \Phalcon\Mvc\ViewBaseInterface {

		const LEVEL_MAIN_LAYOUT = 5;

		const LEVEL_AFTER_TEMPLATE = 4;

		const LEVEL_LAYOUT = 3;

		const LEVEL_BEFORE_TEMPLATE = 2;

		const LEVEL_ACTION_VIEW = 1;

		const LEVEL_NO_RENDER = 0;

		const CACHE_MODE_NONE = 0;

		const CACHE_MODE_INVERSE = 1;

		protected $_options;

		protected $_basePath;

		protected $_content;

		protected $_renderLevel;

		protected $_currentRenderLevel;

		protected $_disabledLevels;

		protected $_viewParams;

		protected $_layout;

		protected $_layoutsDir;

		protected $_partialsDir;

		protected $_viewsDirs;

		protected $_templatesBefore;

		protected $_templatesAfter;

		protected $_engines;

		protected $_registeredEngines;

		protected $_mainView;

		protected $_controllerName;

		protected $_actionName;

		protected $_params;

		protected $_pickView;

		protected $_cache;

		protected $_cacheLevel;

		protected $_activeRenderPaths;

		protected $_disabled;

		public function getRenderLevel(){ }


		public function getCurrentRenderLevel(){ }


		public function getRegisteredEngines(){ }


		public function __construct($options=null){ }


		final protected function _isAbsolutePath($path){ }


		public function setViewsDir($viewsDir){ }


		public function getViewsDir(){ }


		public function setLayoutsDir($layoutsDir){ }


		public function getLayoutsDir(){ }


		public function setPartialsDir($partialsDir){ }


		public function getPartialsDir(){ }


		public function setBasePath($basePath){ }


		public function getBasePath(){ }


		public function setRenderLevel($level){ }


		public function disableLevel($level){ }


		public function setMainView($viewPath){ }


		public function getMainView(){ }


		public function setLayout($layout){ }


		public function getLayout(){ }


		public function setTemplateBefore($templateBefore){ }


		public function cleanTemplateBefore(){ }


		public function setTemplateAfter($templateAfter){ }


		public function cleanTemplateAfter(){ }


		public function setParamToView($key, $value){ }


		public function setVars($params, $merge=null){ }


		public function setVar($key, $value){ }


		public function getVar($key){ }


		public function getParamsToView(){ }


		public function getControllerName(){ }


		public function getActionName(){ }


		public function getParams(){ }


		public function start(){ }


		protected function _loadTemplateEngines(){ }


		protected function _engineRender($engines, $viewPath, $silence, $mustClean, \Phalcon\Cache\BackendInterface $cache=null){ }


		public function registerEngines($engines){ }


		public function exists($view){ }


		public function render($controllerName, $actionName, $params=null){ }


		public function pick($renderView){ }


		public function getPartial($partialPath, $params=null){ }


		public function partial($partialPath, $params=null){ }


		public function getRender($controllerName, $actionName, $params=null, $configCallback=null){ }


		public function finish(){ }


		protected function _createCache(){ }


		public function isCaching(){ }


		public function getCache(){ }


		public function cache($options=null){ }


		public function setContent($content){ }


		public function getContent(){ }


		public function getActiveRenderPath(){ }


		public function disable(){ }


		public function enable(){ }


		public function reset(){ }


		public function __set($key, $value){ }


		public function __get($key){ }


		public function isDisabled(){ }


		public function __isset($key){ }


		protected function getViewsDirs(){ }

	}
}
