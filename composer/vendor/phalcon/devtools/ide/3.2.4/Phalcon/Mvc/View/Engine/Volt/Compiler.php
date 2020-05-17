<?php 

namespace Phalcon\Mvc\View\Engine\Volt {

	class Compiler implements \Phalcon\Di\InjectionAwareInterface {

		protected $_dependencyInjector;

		protected $_view;

		protected $_options;

		protected $_arrayHelpers;

		protected $_level;

		protected $_foreachLevel;

		protected $_blockLevel;

		protected $_exprLevel;

		protected $_extended;

		protected $_autoescape;

		protected $_extendedBlocks;

		protected $_currentBlock;

		protected $_blocks;

		protected $_forElsePointers;

		protected $_loopPointers;

		protected $_extensions;

		protected $_functions;

		protected $_filters;

		protected $_macros;

		protected $_prefix;

		protected $_currentPath;

		protected $_compiledTemplatePath;

		public function __construct(\Phalcon\Mvc\ViewBaseInterface $view=null){ }


		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		public function getDI(){ }


		public function setOptions($options){ }


		public function setOption($option, $value){ }


		public function getOption($option){ }


		public function getOptions(){ }


		final public function fireExtensionEvent($name, $arguments=null){ }


		public function addExtension($extension){ }


		public function getExtensions(){ }


		public function addFunction($name, $definition){ }


		public function getFunctions(){ }


		public function addFilter($name, $definition){ }


		public function getFilters(){ }


		public function setUniquePrefix($prefix){ }


		public function getUniquePrefix(){ }


		public function attributeReader($expr){ }


		public function functionCall($expr){ }


		public function resolveTest($test, $left){ }


		final protected function resolveFilter($filter, $left){ }


		final public function expression($expr){ }


		final protected function _statementListOrExtends($statements){ }


		public function compileForeach($statement, $extendsMode=null){ }


		public function compileForElse(){ }


		public function compileIf($statement, $extendsMode=null){ }


		public function compileElseIf($statement){ }


		public function compileCache($statement, $extendsMode=null){ }


		public function compileSet($statement){ }


		public function compileDo($statement){ }


		public function compileReturn($statement){ }


		public function compileAutoEscape($statement, $extendsMode){ }


		public function compileEcho($statement){ }


		public function compileInclude($statement){ }


		public function compileMacro($statement, $extendsMode){ }


		public function compileCall($statement, $extendsMode){ }


		final protected function _statementList($statements, $extendsMode=null){ }


		protected function _compileSource($viewCode, $extendsMode=null){ }


		public function compileString($viewCode, $extendsMode=null){ }


		public function compileFile($path, $compiledPath, $extendsMode=null){ }


		public function compile($templatePath, $extendsMode=null){ }


		public function getTemplatePath(){ }


		public function getCompiledTemplatePath(){ }


		public function parse($viewCode){ }


		protected function getFinalPath($path){ }

	}
}
