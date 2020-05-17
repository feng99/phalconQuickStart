<?php 

namespace Phalcon\Db {

	class Index implements \Phalcon\Db\IndexInterface {

		protected $_name;

		protected $_columns;

		protected $_type;

		public function getName(){ }


		public function getColumns(){ }


		public function getType(){ }


		public function __construct($name, $columns, $type=null){ }


		public static function __set_state($data){ }

	}
}
