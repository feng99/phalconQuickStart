<?php 

namespace Phalcon\Paginator\Adapter {

	class QueryBuilder extends \Phalcon\Paginator\Adapter implements \Phalcon\Paginator\AdapterInterface {

		protected $_config;

		protected $_builder;

		protected $_columns;

		public function __construct($config){ }


		public function getCurrentPage(){ }


		public function setQueryBuilder(\Phalcon\Mvc\Model\Query\Builder $builder){ }


		public function getQueryBuilder(){ }


		public function getPaginate(){ }

	}
}
