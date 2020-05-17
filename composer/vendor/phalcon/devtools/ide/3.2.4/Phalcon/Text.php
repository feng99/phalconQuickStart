<?php 

namespace Phalcon {

	abstract class Text {

		const RANDOM_ALNUM = 0;

		const RANDOM_ALPHA = 1;

		const RANDOM_HEXDEC = 2;

		const RANDOM_NUMERIC = 3;

		const RANDOM_NOZERO = 4;

		const RANDOM_DISTINCT = 5;

		public static function camelize($str, $delimiter=null){ }


		public static function uncamelize($str, $delimiter=null){ }


		public static function increment($str, $separator=null){ }


		public static function random($type=null, $length=null){ }


		public static function startsWith($str, $start, $ignoreCase=null){ }


		public static function endsWith($str, $end, $ignoreCase=null){ }


		public static function lower($str, $encoding=null){ }


		public static function upper($str, $encoding=null){ }


		public static function reduceSlashes($str){ }


		public static function concat(){ }


		public static function dynamic($text, $leftDelimiter=null, $rightDelimiter=null, $separator=null){ }


		public static function underscore($text){ }


		public static function humanize($text){ }

	}
}
