<?php 

namespace Phalcon\Mvc\Model {

	class Relation implements \Phalcon\Mvc\Model\RelationInterface {

		const BELONGS_TO = 0;

		const HAS_ONE = 1;

		const HAS_MANY = 2;

		const HAS_ONE_THROUGH = 3;

		const HAS_MANY_THROUGH = 4;

		const NO_ACTION = 0;

		const ACTION_RESTRICT = 1;

		const ACTION_CASCADE = 2;

		protected $_type;

		protected $_referencedModel;

		protected $_fields;

		protected $_referencedFields;

		protected $_intermediateModel;

		protected $_intermediateFields;

		protected $_intermediateReferencedFields;

		protected $_options;

		public function __construct($type, $referencedModel, $fields, $referencedFields, $options=null){ }


		public function setIntermediateRelation($intermediateFields, $intermediateModel, $intermediateReferencedFields){ }


		public function getType(){ }


		public function getReferencedModel(){ }


		public function getFields(){ }


		public function getReferencedFields(){ }


		public function getOptions(){ }


		public function getOption($name){ }


		public function isForeignKey(){ }


		public function getForeignKey(){ }


		public function getParams(){ }


		public function isThrough(){ }


		public function isReusable(){ }


		public function getIntermediateFields(){ }


		public function getIntermediateModel(){ }


		public function getIntermediateReferencedFields(){ }

	}
}
