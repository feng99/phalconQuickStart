<?php 

namespace Phalcon\Assets {

	class Manager {

		protected $_options;

		protected $_collections;

		protected $_implicitOutput;

		public function __construct($options=null){ }


		public function setOptions($options){ }


		public function getOptions(){ }


		public function useImplicitOutput($implicitOutput){ }


		public function addCss($path, $local=null, $filter=null, $attributes=null){ }


		public function addInlineCss($content, $filter=null, $attributes=null){ }


		public function addJs($path, $local=null, $filter=null, $attributes=null){ }


		public function addInlineJs($content, $filter=null, $attributes=null){ }


		public function addResourceByType($type, \Phalcon\Assets\Resource $resource){ }


		public function addInlineCodeByType($type, \Phalcon\Assets\Inline $code){ }


		public function addResource(\Phalcon\Assets\Resource $resource){ }


		public function addInlineCode(\Phalcon\Assets\Inline $code){ }


		public function set($id, \Phalcon\Assets\Collection $collection){ }


		public function get($id){ }


		public function getCss(){ }


		public function getJs(){ }


		public function collection($name){ }


		public function collectionResourcesByType($resources, $type){ }


		public function output(\Phalcon\Assets\Collection $collection, $callback, $type){ }


		public function outputInline(\Phalcon\Assets\Collection $collection, $type){ }


		public function outputCss($collectionName=null){ }


		public function outputInlineCss($collectionName=null){ }


		public function outputJs($collectionName=null){ }


		public function outputInlineJs($collectionName=null){ }


		public function getCollections(){ }


		public function exists($id){ }

	}
}
