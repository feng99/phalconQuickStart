<?php 

namespace Phalcon\Db {

	class Column implements \Phalcon\Db\ColumnInterface {

		const TYPE_INTEGER = 0;

		const TYPE_DATE = 1;

		const TYPE_VARCHAR = 2;

		const TYPE_DECIMAL = 3;

		const TYPE_DATETIME = 4;

		const TYPE_CHAR = 5;

		const TYPE_TEXT = 6;

		const TYPE_FLOAT = 7;

		const TYPE_BOOLEAN = 8;

		const TYPE_DOUBLE = 9;

		const TYPE_TINYBLOB = 10;

		const TYPE_BLOB = 11;

		const TYPE_MEDIUMBLOB = 12;

		const TYPE_LONGBLOB = 13;

		const TYPE_BIGINTEGER = 14;

		const TYPE_JSON = 15;

		const TYPE_JSONB = 16;

		const TYPE_TIMESTAMP = 17;

		const BIND_PARAM_NULL = 0;

		const BIND_PARAM_INT = 1;

		const BIND_PARAM_STR = 2;

		const BIND_PARAM_BLOB = 3;

		const BIND_PARAM_BOOL = 5;

		const BIND_PARAM_DECIMAL = 32;

		const BIND_SKIP = 1024;

		protected $_name;

		protected $_schemaName;

		protected $_type;

		protected $_typeReference;

		protected $_typeValues;

		protected $_isNumeric;

		protected $_size;

		protected $_scale;

		protected $_default;

		protected $_unsigned;

		protected $_notNull;

		protected $_primary;

		protected $_autoIncrement;

		protected $_first;

		protected $_after;

		protected $_bindType;

		public function getName(){ }


		public function getSchemaName(){ }


		public function getType(){ }


		public function getTypeReference(){ }


		public function getTypeValues(){ }


		public function getSize(){ }


		public function getScale(){ }


		public function getDefault(){ }


		public function __construct($name, $definition){ }


		public function isUnsigned(){ }


		public function isNotNull(){ }


		public function isPrimary(){ }


		public function isAutoIncrement(){ }


		public function isNumeric(){ }


		public function isFirst(){ }


		public function getAfterPosition(){ }


		public function getBindType(){ }


		public static function __set_state($data){ }


		public function hasDefault(){ }

	}
}
