<?php 

namespace Phalcon\Mvc\Model {

	class Criteria implements \Phalcon\Mvc\Model\CriteriaInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_model;

		protected $_params;

		protected $_bindParams;

		protected $_bindTypes;

		protected $_hiddenParamNumber;

		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setModelName($modelName){ }


		public function getModelName(){ }


		public function bind($bindParams, $merge=null){ }


		public function bindTypes($bindTypes){ }


		public function distinct($distinct){ }


		public function columns($columns){ }


		public function join($model, $conditions=null, $alias=null, $type=null){ }


		public function innerJoin($model, $conditions=null, $alias=null){ }


		public function leftJoin($model, $conditions=null, $alias=null){ }


		public function rightJoin($model, $conditions=null, $alias=null){ }


		public function where($conditions, $bindParams=null, $bindTypes=null){ }


		public function addWhere($conditions, $bindParams=null, $bindTypes=null){ }


		public function andWhere($conditions, $bindParams=null, $bindTypes=null){ }


		public function orWhere($conditions, $bindParams=null, $bindTypes=null){ }


		public function betweenWhere($expr, $minimum, $maximum){ }


		public function notBetweenWhere($expr, $minimum, $maximum){ }


		public function inWhere($expr, $values){ }


		public function notInWhere($expr, $values){ }


		public function conditions($conditions){ }


		public function order($orderColumns){ }


		public function orderBy($orderColumns){ }


		public function groupBy($group){ }


		public function having($having){ }


		public function limit($limit, $offset=null){ }


		public function forUpdate($forUpdate=null){ }


		public function sharedLock($sharedLock=null){ }


		public function cache($cache){ }


		public function getWhere(){ }


		public function getColumns(){ }


		public function getConditions(){ }


		public function getLimit(){ }


		public function getOrderBy(){ }


		public function getGroupBy(){ }


		public function getHaving(){ }


		public function getParams(){ }


		public static function fromInput(\Phalcon\DiInterface $dependencyInjector, $modelName, $data, $operator=null){ }


		public function createBuilder(){ }


		public function execute(){ }

	}
}
