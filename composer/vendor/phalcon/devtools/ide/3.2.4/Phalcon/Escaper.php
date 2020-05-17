<?php 

namespace Phalcon {

	class Escaper implements \Phalcon\EscaperInterface {

		protected $_encoding;

		protected $_htmlEscapeMap;

		protected $_htmlQuoteType;

		protected $_doubleEncode;

		public function setEncoding($encoding){ }


		public function getEncoding(){ }


		public function setHtmlQuoteType($quoteType){ }


		public function setDoubleEncode($doubleEncode){ }


		final public function detectEncoding($str){ }


		final public function normalizeEncoding($str){ }


		public function escapeHtml($text){ }


		public function escapeHtmlAttr($attribute){ }


		public function escapeCss($css){ }


		public function escapeJs($js){ }


		public function escapeUrl($url){ }

	}
}
