<?php 

namespace Phalcon\Paginator {

	abstract class Adapter implements \Phalcon\Paginator\AdapterInterface {

		protected $_limitRows;

		protected $_page;

		public function setCurrentPage($page){ }


		public function setLimit($limitRows){ }


		public function getLimit(){ }

	}
}
