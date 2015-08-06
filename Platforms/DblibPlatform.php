<?php


namespace MssqlBundle\Platforms;

use Doctrine\DBAL\Platforms\SQLServer2008Platform;

/**
 * The DblibPlatform provides the behavior, features and SQL dialect of the
 * MsSQL database platform.
 */
class DblibPlatform extends SQLServer2008Platform
{
    /**
     * Get the platform name for this instance
     *
     * @return string
     */
    public function getName()
    {
        return 'mssql';
    }

   /**
     * {@inheritDoc}
     */
    public function supportsSchemas()
    {
        return true;
    }    
    
    /**
     * {@inheritDoc}
     */
    public function getListTablesSQL()
    {
        // "sysdiagrams" table must be ignored as it's internal SQL Server table for Database Diagrams
        // Category 2 must be ignored as it is "MS SQL Server 'pseudo-system' object[s]" for replication
        return "SELECT scm.name+'.'+obj.name as name FROM sys.tables as obj JOIN sys.schemas as scm on obj.schema_id = scm.schema_id order by obj.name";
    }

    /**
     * {@inheritDoc}
     */
    public function getDateTimeTypeDeclarationSQL(array $fieldDeclaration)
    {
        return 'DATETIME';
    }

    /**
     * {@inheritDoc}
     */
    public function getClobTypeDeclarationSQL(array $field)
    {
        return 'NTEXT';
    }
}
