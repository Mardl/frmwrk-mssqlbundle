<?php


namespace MssqlBundle\Driver\PDODblib;

use Doctrine\DBAL\Driver\Connection as DriverConnection;

/**
 * MsSql/Dblib Connection implementation.
 *
 * @since 2.0
 */
class Connection extends \Doctrine\DBAL\Driver\PDOConnection implements DriverConnection
{
    /**
     * {@inheritdoc}
     */
    public function rollback()
    {
        $this->exec('ROLLBACK TRANSACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        $this->exec('COMMIT TRANSACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function beginTransaction()
    {
        $this->exec('BEGIN TRANSACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function lastInsertId($name = null)
    {
        $stmt = $this->query('SELECT SCOPE_IDENTITY()');
        $id = $stmt->fetchColumn();
        $stmt->closeCursor();
        return $id;
    }
}