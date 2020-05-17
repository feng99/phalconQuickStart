<?php 

namespace Phalcon\Mvc\Model {

	class Query implements \Phalcon\Mvc\Model\QueryInterface, \Phalcon\Di\InjectionAwareInterface {

		const TYPE_SELECT = 309;

		const TYPE_INSERT = 306;

		const TYPE_UPDATE = 300;

		const TYPE_DELETE = 303;

		protected $_dependencyInjector;

		protected $_manager;

		protected $_metaData;

		protected $_type;

		protected $_phql;

		protected $_ast;

		protected $_intermediate;

		protected $_models;

		protected $_sqlAliases;

		protected $_sqlAliasesModels;

		protected $_sqlModelsAliases;

		protected $_sqlAliasesModelsInstances;

		protected $_sqlColumnAliases;

		protected $_modelsInstances;

		protected $_cache;

		protected $_cacheOptions;

		protected $_uniqueRow;

		protected $_bindParams;

		protected $_bindTypes;

		protected $_enableImplicitJoins;

		protected $_sharedLock;

		protected static $_irPhqlCache;

		public function __construct($phql=null, \Phalcon\DiInterface $dependencyInjector=null, $options=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setUniqueRow($uniqueRow){ }


		public function getUniqueRow(){ }


		final protected function _getQualified($expr){ }


		final protected function _getCallArgument($argument){ }


		final protected function _getCaseExpression($expr){ }


		final protected function _getFunctionCall($expr){ }


		final protected function _getExpression($expr, $quoting=null){ }


		final protected function _getSelectColumn($column){ }


		final protected function _getTable(\Phalcon\Mvc\Model\ManagerInterface $manager, $qualifiedName){ }


		final protected function _getJoin(\Phalcon\Mvc\Model\ManagerInterface $manager, $join){ }


		final protected function _getJoinType($join){ }


		final protected function _getSingleJoin($joinType, $joinSource, $modelAlias, $joinAlias, \Phalcon\Mvc\Model\RelationInterface $relation){ }


		final protected function _getMultiJoin($joinType, $joinSource, $modelAlias, $joinAlias, \Phalcon\Mvc\Model\RelationInterface $relation){ }


		final protected function _getJoins($select){ }


		final protected function _getOrderClause($order){ }


		final protected function _getGroupClause($group){ }


		final protected function _getLimitClause($limitClause){ }


		final protected function _prepareSelect($ast=null, $merge=null){ }


		final protected function _prepareInsert(){ }


		final protected function _prepareUpdate(){ }


		final protected function _prepareDelete(){ }


		public function parse(){ }


		public function getCache(){ }


		final protected function _executeSelect($intermediate, $bindParams, $bindTypes, $simulate=null){ }


		final protected function _executeInsert($intermediate, $bindParams, $bindTypes){ }


		final protected function _executeUpdate($intermediate, $bindParams, $bindTypes){ }


		final protected function _executeDelete($intermediate, $bindParams, $bindTypes){ }


		final protected function _getRelatedRecords(\Phalcon\Mvc\ModelInterface $model, $intermediate, $bindParams, $bindTypes){ }


		public function execute($bindParams=null, $bindTypes=null){ }


		public function getSingleResult($bindParams=null, $bindTypes=null){ }


		public function setType($type){ }


		public function getType(){ }


		public function setBindParams($bindParams, $merge=null){ }


		public function getBindParams(){ }


		public function setBindTypes($bindTypes, $merge=null){ }


		public function setSharedLock($sharedLock=null){ }


		public function getBindTypes(){ }


		public function setIntermediate($intermediate){ }


		public function getIntermediate(){ }


		public function cache($cacheOptions){ }


		public function getCacheOptions(){ }


		public function getSql(){ }


		public static function clean(){ }

	}
}
