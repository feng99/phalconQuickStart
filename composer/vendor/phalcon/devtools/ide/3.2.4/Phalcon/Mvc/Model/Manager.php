<?php 

namespace Phalcon\Mvc\Model {

	class Manager implements \Phalcon\Mvc\Model\ManagerInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_customEventsManager;

		protected $_readConnectionServices;

		protected $_writeConnectionServices;

		protected $_aliases;

		protected $_modelVisibility;

		protected $_hasMany;

		protected $_hasManySingle;

		protected $_hasOne;

		protected $_hasOneSingle;

		protected $_belongsTo;

		protected $_belongsToSingle;

		protected $_hasManyToMany;

		protected $_hasManyToManySingle;

		protected $_initialized;

		protected $_prefix;

		protected $_sources;

		protected $_schemas;

		protected $_behaviors;

		protected $_lastInitialized;

		protected $_lastQuery;

		protected $_reusable;

		protected $_keepSnapshots;

		protected $_dynamicUpdate;

		protected $_namespaceAliases;

		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getEventsManager(){ }


		public function setCustomEventsManager(\Phalcon\Mvc\ModelInterface $model, \Phalcon\Events\ManagerInterface $eventsManager){ }


		public function getCustomEventsManager(\Phalcon\Mvc\ModelInterface $model){ }


		public function initialize(\Phalcon\Mvc\ModelInterface $model){ }


		public function isInitialized($modelName){ }


		public function getLastInitialized(){ }


		public function load($modelName, $newInstance=null){ }


		public function setModelPrefix($prefix){ }


		public function getModelPrefix(){ }


		public function setModelSource(\Phalcon\Mvc\ModelInterface $model, $source){ }


		final public function isVisibleModelProperty(\Phalcon\Mvc\ModelInterface $model, $property){ }


		public function getModelSource(\Phalcon\Mvc\ModelInterface $model){ }


		public function setModelSchema(\Phalcon\Mvc\ModelInterface $model, $schema){ }


		public function getModelSchema(\Phalcon\Mvc\ModelInterface $model){ }


		public function setConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService){ }


		public function setWriteConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService){ }


		public function setReadConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService){ }


		public function getReadConnection(\Phalcon\Mvc\ModelInterface $model){ }


		public function getWriteConnection(\Phalcon\Mvc\ModelInterface $model){ }


		protected function _getConnection(\Phalcon\Mvc\ModelInterface $model, $connectionServices){ }


		public function getReadConnectionService(\Phalcon\Mvc\ModelInterface $model){ }


		public function getWriteConnectionService(\Phalcon\Mvc\ModelInterface $model){ }


		public function _getConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionServices){ }


		public function notifyEvent($eventName, \Phalcon\Mvc\ModelInterface $model){ }


		public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $eventName, $data){ }


		public function addBehavior(\Phalcon\Mvc\ModelInterface $model, \Phalcon\Mvc\Model\BehaviorInterface $behavior){ }


		public function keepSnapshots(\Phalcon\Mvc\ModelInterface $model, $keepSnapshots){ }


		public function isKeepingSnapshots(\Phalcon\Mvc\ModelInterface $model){ }


		public function useDynamicUpdate(\Phalcon\Mvc\ModelInterface $model, $dynamicUpdate){ }


		public function isUsingDynamicUpdate(\Phalcon\Mvc\ModelInterface $model){ }


		public function addHasOne(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null){ }


		public function addBelongsTo(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null){ }


		public function addHasMany(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null){ }


		public function addHasManyToMany(\Phalcon\Mvc\ModelInterface $model, $fields, $intermediateModel, $intermediateFields, $intermediateReferencedFields, $referencedModel, $referencedFields, $options=null){ }


		public function existsBelongsTo($modelName, $modelRelation){ }


		public function existsHasMany($modelName, $modelRelation){ }


		public function existsHasOne($modelName, $modelRelation){ }


		public function existsHasManyToMany($modelName, $modelRelation){ }


		public function getRelationByAlias($modelName, $alias){ }


		final protected function _mergeFindParameters($findParamsOne, $findParamsTwo){ }


		public function getRelationRecords(\Phalcon\Mvc\Model\RelationInterface $relation, $method, \Phalcon\Mvc\ModelInterface $record, $parameters=null){ }


		public function getReusableRecords($modelName, $key){ }


		public function setReusableRecords($modelName, $key, $records){ }


		public function clearReusableObjects(){ }


		public function getBelongsToRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters=null){ }


		public function getHasManyRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters=null){ }


		public function getHasOneRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters=null){ }


		public function getBelongsTo(\Phalcon\Mvc\ModelInterface $model){ }


		public function getHasMany(\Phalcon\Mvc\ModelInterface $model){ }


		public function getHasOne(\Phalcon\Mvc\ModelInterface $model){ }


		public function getHasManyToMany(\Phalcon\Mvc\ModelInterface $model){ }


		public function getHasOneAndHasMany(\Phalcon\Mvc\ModelInterface $model){ }


		public function getRelations($modelName){ }


		public function getRelationsBetween($first, $second){ }


		public function createQuery($phql){ }


		public function executeQuery($phql, $placeholders=null, $types=null){ }


		public function createBuilder($params=null){ }


		public function getLastQuery(){ }


		public function registerNamespaceAlias($alias, $namespaceName){ }


		public function getNamespaceAlias($alias){ }


		public function getNamespaceAliases(){ }


		public function __destruct(){ }

	}
}
