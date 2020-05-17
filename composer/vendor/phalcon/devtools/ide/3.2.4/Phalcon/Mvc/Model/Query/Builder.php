<?php 

namespace Phalcon\Mvc\Model\Query {

	class Builder implements \Phalcon\Mvc\Model\Query\BuilderInterface, \Phalcon\Di\InjectionAwareInterface {

		const OPERATOR_OR = or;

		const OPERATOR_AND = and;

		protected $_dependencyInjector;

		protected $_columns;

		protected $_models;

		protected $_joins;

		protected $_with;

		protected $_conditions;

		protected $_group;

		protected $_having;

		protected $_order;

		protected $_limit;

		protected $_offset;

		protected $_forUpdate;

		protected $_sharedLock;

		protected $_bindParams;

		protected $_bindTypes;

		protected $_distinct;

		protected $_hiddenParamNumber;

		public function __construct($params=null, \Phalcon\DiInterface $dependencyInjector=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function distinct($distinct){ }


		public function getDistinct(){ }


		public function columns($columns){ }


		public function getColumns(){ }


		public function from($models){ }


		public function addFrom($model, $alias=null, $with=null){ }


		public function getFrom(){ }


		public function join($model, $conditions=null, $alias=null, $type=null){ }


		public function innerJoin($model, $conditions=null, $alias=null){ }


		public function leftJoin($model, $conditions=null, $alias=null){ }


		public function rightJoin($model, $conditions=null, $alias=null){ }


		public function getJoins(){ }


		public function where($conditions, $bindParams=null, $bindTypes=null){ }


		public function andWhere($conditions, $bindParams=null, $bindTypes=null){ }


		public function orWhere($conditions, $bindParams=null, $bindTypes=null){ }


		public function betweenWhere($expr, $minimum, $maximum, $operator=null){ }


		public function notBetweenWhere($expr, $minimum, $maximum, $operator=null){ }


		public function inWhere($expr, $values, $operator=null){ }


		public function notInWhere($expr, $values, $operator=null){ }


		public function getWhere(){ }


		public function orderBy($orderBy){ }


		public function getOrderBy(){ }


		public function having($conditions, $bindParams=null, $bindTypes=null){ }


		public function andHaving($conditions, $bindParams=null, $bindTypes=null){ }


		public function orHaving($conditions, $bindParams=null, $bindTypes=null){ }


		public function betweenHaving($expr, $minimum, $maximum, $operator=null){ }


		public function notBetweenHaving($expr, $minimum, $maximum, $operator=null){ }


		public function inHaving($expr, $values, $operator=null){ }


		public function notInHaving($expr, $values, $operator=null){ }


		public function getHaving(){ }


		public function forUpdate($forUpdate){ }


		public function limit($limit, $offset=null){ }


		public function getLimit(){ }


		public function offset($offset){ }


		public function getOffset(){ }


		public function groupBy($group){ }


		public function getGroupBy(){ }


		final public function getPhql(){ }


		public function getQuery(){ }


		final public function autoescape($identifier){ }


		protected function _conditionBetween($clause, $operator, $expr, $minimum, $maximum){ }


		protected function _conditionNotBetween($clause, $operator, $expr, $minimum, $maximum){ }


		protected function _conditionIn($clause, $operator, $expr, $values){ }


		protected function _conditionNotIn($clause, $operator, $expr, $values){ }

	}
}
