<?php

/**
 * dibi - tiny'n'smart database abstraction layer
 * ----------------------------------------------
 *
 * Copyright (c) 2005, 2007 David Grudl aka -dgx- (http://www.dgx.cz)
 *
 * This source file is subject to the "dibi license" that is bundled
 * with this package in the file license.txt.
 *
 * For more information please see http://php7.org/dibi/
 *
 * @author     David Grudl
 * @copyright  Copyright (c) 2005, 2007 David Grudl
 * @license    http://php7.org/dibi/license  (dibi license)
 * @category   Database
 * @package    Dibi
 * @link       http://php7.org/dibi/
 */


/**
 * The dibi driver for Oracle database
 *
 * @version $Revision$ $Date$
 */
class DibiOracleDriver extends DibiDriver
{
    public $formats = array(
        'TRUE'     => "1",
        'FALSE'    => "0",
        'date'     => "U",
        'datetime' => "U",
    );

    private $autocommit = TRUE;



    /**
     * @param array  connect configuration
     * @throws DibiException
     */
    public function __construct($config)
    {
        self::prepare($config, 'username', 'user');
        self::prepare($config, 'password', 'pass');
        self::prepare($config, 'database', 'db');
        self::prepare($config, 'charset');
        parent::__construct($config);
    }



    protected function connect()
    {
        if (!extension_loaded('oci8')) {
            throw new DibiException("PHP extension 'oci8' is not loaded");
        }

        $config = $this->getConfig();
        $connection = @oci_new_connect($config['username'], $config['password'], $config['database'], $config['charset']);

        if (!$connection) {
            $err = oci_error();
            throw new DibiDatabaseException($err['message'], $err['code']);
        }

        dibi::notify('connected', $this);
        return $connection;
    }



    protected function doQuery($sql)
    {
        $connection = $this->getConnection();

        $statement = oci_parse($connection, $sql);
        if ($statement) {
            $res = oci_execute($statement, $this->autocommit ? OCI_COMMIT_ON_SUCCESS : OCI_DEFAULT);
            if (!$res) {
                $err = oci_error($statement);
                throw new DibiDatabaseException($err['message'], $err['code'], $sql);
            }
        } else {
            $err = oci_error($connection);
            throw new DibiDatabaseException($err['message'], $err['code'], $sql);
        }

        // TODO!
        return is_resource($res) ? new DibiOracleResult($statement) : TRUE;
    }



    public function affectedRows()
    {
        throw new DibiException(__METHOD__ . ' is not implemented');
    }



    public function insertId()
    {
        throw new DibiException(__METHOD__ . ' is not implemented');
    }



    public function begin()
    {
        $this->autocommit = FALSE;
    }



    public function commit()
    {
        $connection = $this->getConnection();
        if (!oci_commit($connection)) {
            $err = oci_error($connection);
            throw new DibiDatabaseException($err['message'], $err['code']);
        }
        $this->autocommit = TRUE;
        dibi::notify('commit', $this);
    }



    public function rollback()
    {
        $connection = $this->getConnection();
        if (!oci_rollback($connection)) {
            $err = oci_error($connection);
            throw new DibiDatabaseException($err['message'], $err['code']);
        }
        $this->autocommit = TRUE;
        dibi::notify('rollback', $this);
    }



    public function errorInfo()
    {
        return oci_error($this->getConnection());
    }



    public function escape($value, $appendQuotes = TRUE)
    {
        return $appendQuotes
               ? "'" . sqlite_escape_string($value) . "'"
               : sqlite_escape_string($value);
    }



    public function delimite($value)
    {
        return '[' . str_replace('.', '].[', $value) . ']';
    }



    public function getMetaData()
    {
        throw new DibiException(__METHOD__ . ' is not implemented');
    }



    /**
     * @see DibiDriver::applyLimit()
     */
    public function applyLimit(&$sql, $limit, $offset = 0)
    {
        if ($limit < 0 && $offset < 1) return;
        $sql .= ' LIMIT ' . $limit . ($offset > 0 ? ' OFFSET ' . (int) $offset : '');
    }

} // class DibiOracleDriver









class DibiOracleResult extends DibiResult
{

    public function rowCount()
    {
        return oci_num_rows($this->resource);
    }



    protected function doFetch()
    {
        return oci_fetch_assoc($this->resource);
    }



    public function seek($row)
    {
        //throw new DibiException(__METHOD__ . ' is not implemented');
    }



    protected function free()
    {
        oci_free_statement($this->resource);
    }



    /** this is experimental */
    protected function buildMeta()
    {
        $count = oci_num_fields($this->resource);
        $this->meta = $this->convert = array();
        for ($index = 0; $index < $count; $index++) {
            $name = oci_field_name($this->resource, $index + 1);
            $this->meta[$name] = array('type' => dibi::FIELD_UNKNOWN);
            $this->convert[$name] = dibi::FIELD_UNKNOWN;
        }
    }


} // class DibiOracleResult
