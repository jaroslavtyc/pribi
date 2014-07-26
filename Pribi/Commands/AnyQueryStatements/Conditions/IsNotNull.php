<?php
namespace Pribi\Commands\AnyQueryStatements\Conditions;

use Pribi\Commands\AnyQueryStatements\Conditions\Base\Null;

class IsNotNull extends Null {
	protected function toSql() {
		return 'IS NOT NULL';
	}
}
