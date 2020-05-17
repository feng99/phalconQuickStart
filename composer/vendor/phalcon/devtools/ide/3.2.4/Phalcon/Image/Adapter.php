<?php 

namespace Phalcon\Image {

	abstract class Adapter implements \Phalcon\Image\AdapterInterface {

		protected $_image;

		protected $_file;

		protected $_realpath;

		protected $_width;

		protected $_height;

		protected $_type;

		protected $_mime;

		protected static $_checked;

		public function getImage(){ }


		public function getRealpath(){ }


		public function getWidth(){ }


		public function getHeight(){ }


		public function getType(){ }


		public function getMime(){ }


		public function resize($width=null, $height=null, $master=null){ }


		public function liquidRescale($width, $height, $deltaX=null, $rigidity=null){ }


		public function crop($width, $height, $offsetX=null, $offsetY=null){ }


		public function rotate($degrees){ }


		public function flip($direction){ }


		public function sharpen($amount){ }


		public function reflection($height, $opacity=null, $fadeIn=null){ }


		public function watermark(\Phalcon\Image\Adapter $watermark, $offsetX=null, $offsetY=null, $opacity=null){ }


		public function text($text, $offsetX=null, $offsetY=null, $opacity=null, $color=null, $size=null, $fontfile=null){ }


		public function mask(\Phalcon\Image\Adapter $watermark){ }


		public function background($color, $opacity=null){ }


		public function blur($radius){ }


		public function pixelate($amount){ }


		public function save($file=null, $quality=null){ }


		public function render($ext=null, $quality=null){ }

	}
}
