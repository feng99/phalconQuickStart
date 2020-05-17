<?php 

namespace Phalcon\Db {

	class Reference implements \Phalcon\Db\ReferenceInterface {

		protected $_name;

		protected $_schemaName;

		protected $_referencedSchema;

		protected $_referencedTable;

		protected $_columns;

		protected $_referencedColumns;

		protected $_onDelete;

		protected $_onUpdate;

		public function getName(){ }


		public function getSchemaName(){ }


		public function getReferencedSchema(){ }


		public function getReferencedTable(){ }


		public function getColumns(){ }


		public function getReferencedColumns(){ }


		public function getOnDelete(){ }


		public function getOnUpdate(){ }


		public function __construct($name, $definition){ }


		public static function __set_state($data){ }

	}
}
