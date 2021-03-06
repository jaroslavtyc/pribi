<?php
// This is global bootstrap for autoloading

require __DIR__ . '/../vendor/autoload.php';

/*
 * Simple autoloader using the PCR-0 Pribi naming convention, @see http://www.php-fig.org/psr/psr-0/
 * For example Pribi\Commands\AnyQueryStatements\Inserts\Insert is searched in "__DIR__ . '/../Pribi/Commands/Inserts/Insert.php" file.
 */
spl_autoload_register(
	function ($className) {
		$classFilename = __DIR__ . '/../' . str_replace('\\', '/', $className) . '.php';
		if (file_exists($classFilename)) {
			require $classFilename;
		}
	},
	TRUE /* throw exception if this autoloader can not be registered */,
	FALSE /* do not prepend this autoloader before already registered */
);
