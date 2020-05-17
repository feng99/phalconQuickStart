<?php 

namespace Phalcon {

	class Filter implements \Phalcon\FilterInterface {

		const FILTER_EMAIL = email;

		const FILTER_ABSINT = absint;

		const FILTER_INT = int;

		const FILTER_INT_CAST = int!;

		const FILTER_STRING = string;

		const FILTER_FLOAT = float;

		const FILTER_FLOAT_CAST = float!;

		const FILTER_ALPHANUM = alphanum;

		const FILTER_TRIM = trim;

		const FILTER_STRIPTAGS = striptags;

		const FILTER_LOWER = lower;

		const FILTER_UPPER = upper;

		const FILTER_URL = url;

		const FILTER_SPECIAL_CHARS = special_chars;

		protected $_filters;

		public function add($name, $handler){ }


		public function sanitize($value, $filters, $noRecursive=null){ }


		protected function _sanitize($value, $filter){ }


		public function getFilters(){ }

	}
}
