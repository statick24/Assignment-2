<?php

namespace Model;

use \mysqli;

/**
 * Abstract ORM Class
 *
 * This abstract class provides a partial implementation of the ORMInterface
 * for interacting with a database using Object-Relational Mapping (ORM)
 * within the MVP framework's model module.
 */
abstract class AbstractORM implements InterfaceORM
{
    /**
     * @var mysqli The MySQL database connection.
     */
    protected mysqli $db;
    /**
     * @var string The current table for ORM operations.
     */
    protected $table;

    public function __construct($host, $username, $password, $database)
    {
        $this->db = new mysqli($host, $username, $password, $database);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
    public function connect($host, $username, $password, $database)
    {
        $this->disconnect();
        $this->db = new mysqli($host, $username, $password, $database);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    abstract public function create($data, $table = null);
    abstract public function read($table = null, $column = "", $value = "");
    abstract public function update($id, $data, $table = null);
    abstract public function delete($id, $table = null);

    public function checkTable($table)
    {
        $sql = "SHOW TABLES LIKE '$table'";
        $result = $this->db->query($sql);

        if ($result !== false && $result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkColumns($columns, $table)
    {
        
        $columnArray = explode(', ', $columns);
        $col_count = count($columnArray);

        // Add single quotes around each element in the array
        $columns = "'" . implode("', '", $columnArray) . "'";


        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table' AND COLUMN_NAME IN ($columns)";
        $result = $this->db->query($sql);
        if ($result !== false && $result->num_rows === $col_count) {
            return true;
        } else {
            return false; 
        }
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function disconnect()
    {
        $this->db->close();
    }

    /**
     * Destructor
     *
     * The destructor method is automatically called when there are no more references to an object
     * or when the script ends. In this implementation, it ensures that the database connection is closed.
     */
    public function __destruct()
    {
        $this->disconnect();
    }
}
