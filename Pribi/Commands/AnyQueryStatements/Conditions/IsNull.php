<?php
namespace Pribi\Commands\AnyQueryStatements\Conditions;

use Pribi\Commands\AnyQueryStatements\Conditions\Base\Null;

class IsNull extends Null {
	protected function toSql() {
		return 'IS NULL';
	}
}