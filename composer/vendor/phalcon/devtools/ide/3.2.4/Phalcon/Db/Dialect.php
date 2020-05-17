<?php 

namespace Phalcon\Db {

	abstract class Dialect implements \Phalcon\Db\DialectInterface {

		protected $_escapeChar;

		protected $_customFunctions;

		public function registerCustomFunction($name, $customFunction){ }


		public function getCustomFunctions(){ }


		final public function escapeSchema($str, $escapeChar=null){ }


		final public function escape($str, $escapeChar=null){ }


		public function limit($sqlQuery, $number){ }


		public function forUpdate($sqlQuery){ }


		public function sharedLock($sqlQuery){ }


		final public function getColumnList($columnList, $escapeChar=null, $bindCounts=null){ }


		final public function getSqlColumn($column, $escapeChar=null, $bindCounts=null){ }


		public function getSqlExpression($expression, $escapeChar=null, $bindCounts=null){ }


		final public function getSqlTable($table, $escapeChar=null){ }


		public function select($definition){ }


		public function supportsSavepoints(){ }


		public function supportsReleaseSavepoints(){ }


		public function createSavepoint($name){ }


		public function releaseSavepoint($name){ }


		public function rollbackSavepoint($name){ }


		final protected function getSqlExpressionScalar($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionObject($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionQualified($expression, $escapeChar=null){ }


		final protected function getSqlExpressionBinaryOperations($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionUnaryOperations($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionFunctionCall($expression, $escapeChar, $bindCounts=null){ }


		final protected function getSqlExpressionList($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionAll($expression, $escapeChar=null){ }


		final protected function getSqlExpressionCastValue($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionConvertValue($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionCase($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionFrom($expression, $escapeChar=null){ }


		final protected function getSqlExpressionJoins($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionWhere($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionGroupBy($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionHaving($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionOrderBy($expression, $escapeChar=null, $bindCounts=null){ }


		final protected function getSqlExpressionLimit($expression, $escapeChar=null, $bindCounts=null){ }


		protected function prepareColumnAlias($qualified, $alias=null, $escapeChar=null){ }


		protected function prepareTable($table, $schema=null, $alias=null, $escapeChar=null){ }


		protected function prepareQualified($column, $domain=null, $escapeChar=null){ }

	}
}
