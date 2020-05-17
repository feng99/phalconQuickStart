<?php 

namespace Phalcon\Assets {

	class Collection implements \Countable, \Iterator, \Traversable {

		protected $_prefix;

		protected $_local;

		protected $_resources;

		protected $_codes;

		protected $_position;

		protected $_filters;

		protected $_attributes;

		protected $_join;

		protected $_targetUri;

		protected $_targetPath;

		protected $_targetLocal;

		protected $_sourcePath;

		protected $_includedResources;

		public function getPrefix(){ }


		public function getLocal(){ }


		public function getResources(){ }


		public function getCodes(){ }


		public function getPosition(){ }


		public function getFilters(){ }


		public function getAttributes(){ }


		public function getJoin(){ }


		public function getTargetUri(){ }


		public function getTargetPath(){ }


		public function getTargetLocal(){ }


		public function getSourcePath(){ }


		public function __construct(){ }


		public function add(\Phalcon\Assets\Resource $resource){ }


		public function addInline(\Phalcon\Assets\Inline $code){ }


		public function has(\Phalcon\Assets\ResourceInterface $resource){ }


		public function addCss($path, $local=null, $filter=null, $attributes=null){ }


		public function addInlineCss($content, $filter=null, $attributes=null){ }


		public function addJs($path, $local=null, $filter=null, $attributes=null){ }


		public function addInlineJs($content, $filter=null, $attributes=null){ }


		public function count(){ }


		public function rewind(){ }


		public function current(){ }


		public function key(){ }


		public function next(){ }


		public function valid(){ }


		public function setTargetPath($targetPath){ }


		public function setSourcePath($sourcePath){ }


		public function setTargetUri($targetUri){ }


		public function setPrefix($prefix){ }


		public function setLocal($local){ }


		public function setAttributes($attributes){ }


		public function setFilters($filters){ }


		public function setTargetLocal($targetLocal){ }


		public function join($join){ }


		public function getRealTargetPath($basePath){ }


		public function addFilter(\Phalcon\Assets\FilterInterface $filter){ }


		final protected function addResource(\Phalcon\Assets\ResourceInterface $resource){ }

	}
}
