<?php 

namespace Phalcon {

	class Tag {

		const HTML32 = 1;

		const HTML401_STRICT = 2;

		const HTML401_TRANSITIONAL = 3;

		const HTML401_FRAMESET = 4;

		const HTML5 = 5;

		const XHTML10_STRICT = 6;

		const XHTML10_TRANSITIONAL = 7;

		const XHTML10_FRAMESET = 8;

		const XHTML11 = 9;

		const XHTML20 = 10;

		const XHTML5 = 11;

		protected static $_displayValues;

		protected static $_documentTitle;

		protected static $_documentAppendTitle;

		protected static $_documentPrependTitle;

		protected static $_documentTitleSeparator;

		protected static $_documentType;

		protected static $_dependencyInjector;

		protected static $_urlService;

		protected static $_dispatcherService;

		protected static $_escaperService;

		protected static $_autoEscape;

		public static function getEscaper($params){ }


		public static function renderAttributes($code, $attributes){ }


		public static function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public static function getDI(){ }


		public static function getUrlService(){ }


		public static function getEscaperService(){ }


		public static function setAutoescape($autoescape){ }


		public static function setDefault($id, $value){ }


		public static function setDefaults($values, $merge=null){ }


		public static function displayTo($id, $value){ }


		public static function hasValue($name){ }


		public static function getValue($name, $params=null){ }


		public static function resetInput(){ }


		public static function linkTo($parameters, $text=null, $local=null){ }


		final protected static function _inputField($type, $parameters, $asValue=null){ }


		final protected static function _inputFieldChecked($type, $parameters){ }


		public static function colorField($parameters){ }


		public static function textField($parameters){ }


		public static function numericField($parameters){ }


		public static function rangeField($parameters){ }


		public static function emailField($parameters){ }


		public static function dateField($parameters){ }


		public static function dateTimeField($parameters){ }


		public static function dateTimeLocalField($parameters){ }


		public static function monthField($parameters){ }


		public static function timeField($parameters){ }


		public static function weekField($parameters){ }


		public static function passwordField($parameters){ }


		public static function hiddenField($parameters){ }


		public static function fileField($parameters){ }


		public static function searchField($parameters){ }


		public static function telField($parameters){ }


		public static function urlField($parameters){ }


		public static function checkField($parameters){ }


		public static function radioField($parameters){ }


		public static function imageInput($parameters){ }


		public static function submitButton($parameters){ }


		public static function selectStatic($parameters, $data=null){ }


		public static function select($parameters, $data=null){ }


		public static function textArea($parameters){ }


		public static function form($parameters){ }


		public static function endForm(){ }


		public static function setTitle($title){ }


		public static function setTitleSeparator($titleSeparator){ }


		public static function appendTitle($title){ }


		public static function prependTitle($title){ }


		public static function getTitle($tags=null){ }


		public static function getTitleSeparator(){ }


		public static function stylesheetLink($parameters=null, $local=null){ }


		public static function javascriptInclude($parameters=null, $local=null){ }


		public static function image($parameters=null, $local=null){ }


		public static function friendlyTitle($text, $separator=null, $lowercase=null, $replace=null){ }


		public static function setDocType($doctype){ }


		public static function getDocType(){ }


		public static function tagHtml($tagName, $parameters=null, $selfClose=null, $onlyStart=null, $useEol=null){ }


		public static function tagHtmlClose($tagName, $useEol=null){ }

	}
}
