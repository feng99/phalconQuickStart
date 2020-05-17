<?php 

namespace Phalcon\Http\Request {

	class File implements \Phalcon\Http\Request\FileInterface {

		protected $_name;

		protected $_tmp;

		protected $_size;

		protected $_type;

		protected $_realType;

		protected $_error;

		protected $_key;

		protected $_extension;

		public function getError(){ }


		public function getKey(){ }


		public function getExtension(){ }


		public function __construct($file, $key=null){ }


		public function getSize(){ }


		public function getName(){ }


		public function getTempName(){ }


		public function getType(){ }


		public function getRealType(){ }


		public function isUploadedFile(){ }


		public function moveTo($destination){ }

	}
}
