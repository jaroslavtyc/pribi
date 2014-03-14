<?php
namespace Pribi\Commands\Selects\Base;

use Pribi\Commands\Identifiers\IdentifierAlias;
use Pribi\Commands\Limits\Base\Limitable;
use Pribi\Commands\Limits\Base\Limiting;
use Pribi\Commands\Selects\Base\AfterSelecting;

abstract class BaseSelectAlias extends IdentifierAlias implements SelectIdentifiable, AfterSelectUsable, Limitable {
	use AfterSelecting;
	use Limiting;

	protected function toSql() {
		return 'AS ' . $this->getIdentifier()->toSql();
	}
}
