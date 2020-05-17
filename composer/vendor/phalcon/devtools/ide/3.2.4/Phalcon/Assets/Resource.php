<?php 

namespace Phalcon\Assets {

	class Resource implements \Phalcon\Assets\ResourceInterface {

		protected $_type;

		protected $_path;

		protected $_local;

		protected $_filter;

		protected $_attributes;

		protected $_sourcePath;

		protected $_targetPath;

		protected $_targetUri;

		public function getType(){ }


		public function getPath(){ }


		public function getLocal(){ }


		public function getFilter(){ }


		public function getAttributes(){ }


		public function getSourcePath(){ }


		public function getTargetPath(){ }


		public function getTargetUri(){ }


		public function __construct($type, $path, $local=null, $filter=null, $attributes=null){ }


		public function setType($type){ }


		public function setPath($path){ }


		public function setLocal($local){ }


		public function setFilter($filter){ }


		public function setAttributes($attributes){ }


		public function setTargetUri($targetUri){ }


		public function setSourcePath($sourcePath){ }


		public function setTargetPath($targetPath){ }


		public function getContent($basePath=null){ }


		public function getRealTargetUri(){ }


		public function getRealSourcePath($basePath=null){ }


		public function getRealTargetPath($basePath=null){ }


		public function getResourceKey(){ }

	}
}
