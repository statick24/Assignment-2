<?php

namespace Model;

/**
 * ORM Interface
 *
 * This interface defines methods for interacting with a database through an Object-Relational Mapping (ORM)
 * within the MVP framework's model module.
 */
interface InterfaceORM
{
    /**
     * Connect to Database
     *
     * Establishes a connection to the database with the provided credentials.
     *
     * @param string $host     The database host.
     * @param string $username The database username.
     * @param string $password The database password.
     * @param string $database The name of the database.
     */
    public function connect($host, $username, $password, $database);
    /**
     * Create Record
     *
     * Inserts a new record into the specified table with the provided data.
     *
     * @param array  $data  An associative array representing the data to be inserted.
     * @param string $table (Optional) The name of the table. If not provided, uses the current table set via setTable.
     */
    public function create($data, $table = null);
    /**
     * Read Records
     *
     * Retrieves records from the specified table based on the provided criteria.
     *
     * @param string $table  (Optional) The name of the table. If not provided, uses the current table set via setTable.
     * @param string $column (Optional) The column to filter on.
     * @param mixed  $value  (Optional) The value to match in the specified column.
     *
     * @return array An array of records matching the criteria.
     */
    public function read($table = null, $column = "", $value = "");
    /**
     * Update Record
     *
     * Updates a record in the specified table with the provided data.
     *
     * @param mixed  $id    The unique identifier of the record to be updated.
     * @param array  $data  An associative array representing the data to be updated.
     * @param string $table (Optional) The name of the table. If not provided, uses the current table set via setTable.
     */
    public function update($id, $data, $table = null);
    /**
     * Delete Record
     *
     * Deletes a record from the specified table based on the provided identifier.
     *
     * @param mixed  $id    The unique identifier of the record to be deleted.
     * @param string $table (Optional) The name of the table. If not provided, uses the current table set via setTable.
     */
    public function delete($id, $table = null);
    /**
     * Set Current Table
     *
     * Sets the current table for subsequent ORM operations.
     *
     * @param string $table The name of the table.
     */
    public function setTable($table);
    /**
     * Check Columns Existence
     *
     * Checks if specified columns exist in the current table.
     *
     * @param string $columns An array of column names to check for existence.
     * @param string $table A string containing the table to check
     * @return bool True if all columns exist, false otherwise.
     */
    public function checkColumns($columns,$table);
    /**
     * Disconnect from Database
     *
     * Closes the connection to the database.
     */
    public function disconnect();
}
