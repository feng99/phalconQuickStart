<?php 

namespace Phalcon\Mvc\Model {

	abstract class MetaData implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\Model\MetaDataInterface {

		const MODELS_ATTRIBUTES = 0;

		const MODELS_PRIMARY_KEY = 1;

		const MODELS_NON_PRIMARY_KEY = 2;

		const MODELS_NOT_NULL = 3;

		const MODELS_DATA_TYPES = 4;

		const MODELS_DATA_TYPES_NUMERIC = 5;

		const MODELS_DATE_AT = 6;

		const MODELS_DATE_IN = 7;

		const MODELS_IDENTITY_COLUMN = 8;

		const MODELS_DATA_TYPES_BIND = 9;

		const MODELS_AUTOMATIC_DEFAULT_INSERT = 10;

		const MODELS_AUTOMATIC_DEFAULT_UPDATE = 11;

		const MODELS_DEFAULT_VALUES = 12;

		const MODELS_EMPTY_STRING_VALUES = 13;

		const MODELS_COLUMN_MAP = 0;

		const MODELS_REVERSE_COLUMN_MAP = 1;

		protected $_dependencyInjector;

		protected $_strategy;

		protected $_metaData;

		protected $_columnMap;

		final protected function _initialize(\Phalcon\Mvc\ModelInterface $model, $key, $table, $schema){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setStrategy(\Phalcon\Mvc\Model\MetaData\StrategyInterface $strategy){ }


		public function getStrategy(){ }


		final public function readMetaData(\Phalcon\Mvc\ModelInterface $model){ }


		final public function readMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index){ }


		final public function writeMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index, $data){ }


		final public function readColumnMap(\Phalcon\Mvc\ModelInterface $model){ }


		final public function readColumnMapIndex(\Phalcon\Mvc\ModelInterface $model, $index){ }


		public function getAttributes(\Phalcon\Mvc\ModelInterface $model){ }


		public function getPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model){ }


		public function getNonPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model){ }


		public function getNotNullAttributes(\Phalcon\Mvc\ModelInterface $model){ }


		public function getDataTypes(\Phalcon\Mvc\ModelInterface $model){ }


		public function getDataTypesNumeric(\Phalcon\Mvc\ModelInterface $model){ }


		public function getIdentityField(\Phalcon\Mvc\ModelInterface $model){ }


		public function getBindTypes(\Phalcon\Mvc\ModelInterface $model){ }


		public function getAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model){ }


		public function getAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model){ }


		public function setAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model, $attributes){ }


		public function setAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model, $attributes){ }


		public function setEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model, $attributes){ }


		public function getEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model){ }


		public function getDefaultValues(\Phalcon\Mvc\ModelInterface $model){ }


		public function getColumnMap(\Phalcon\Mvc\ModelInterface $model){ }


		public function getReverseColumnMap(\Phalcon\Mvc\ModelInterface $model){ }


		public function hasAttribute(\Phalcon\Mvc\ModelInterface $model, $attribute){ }


		public function isEmpty(){ }


		public function reset(){ }

	}
}
