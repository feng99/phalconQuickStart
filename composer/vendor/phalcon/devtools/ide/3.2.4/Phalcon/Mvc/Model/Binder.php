<?php 

namespace Phalcon\Mvc\Model {

	class Binder implements \Phalcon\Mvc\Model\BinderInterface {

		protected $boundModels;

		protected $cache;

		protected $internalCache;

		protected $originalValues;

		public function getBoundModels(){ }


		public function getOriginalValues(){ }


		public function __construct(\Phalcon\Cache\BackendInterface $cache=null){ }


		public function setCache(\Phalcon\Cache\BackendInterface $cache){ }


		public function getCache(){ }


		public function bindToHandler($handler, $params, $cacheKey, $methodName=null){ }


		protected function findBoundModel($paramValue, $className){ }


		protected function getParamsFromCache($cacheKey){ }


		protected function getParamsFromReflection($handler, $params, $cacheKey, $methodName){ }

	}
}
