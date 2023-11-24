<?php

namespace Model;

use \Controller\Security;

/**
 * ORM Class
 *
 * This class extends the AbstractORM class, providing specific implementations
 * for the remaining ORM-related methods within the MVP framework's model module.
 */
class ORM extends AbstractORM
{
    public function create($data, $table = null)
    {

        $table = $table ?? $this->table; // if table wasn't passed use $this->table
        //If data is empty throw error
        if(empty($data)){
            trigger_error("No data passed to function", E_USER_ERROR);
        }
        $columns = implode(", ", array_keys($data));
        //If table is empty throw error
        if (empty($table)) {
            trigger_error("Table isn't set", E_USER_ERROR);
        }
        //Check if table exists in database
        if (!$this->checkTable($table)) {
            trigger_error("Table: $table doesn't exist in database", E_USER_ERROR);
        }
        //Check if columns exist in table
        if (!$this->checkColumns($columns, $table)) {
            trigger_error("Column(s): $columns do not exist in $table", E_USER_ERROR);
        }
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO " . $table . " ($columns) VALUES ($placeholders)";

        //Find the types of the data
        $types = "";
        foreach ($data as $key => $value) {
            if (is_int($value)) {
                $types .= "i";
            } else if (is_float($value)) {
                $types .= "d";
            } else if (is_string($value)) {
                $types .= "s";
            }
        }
        //Prepare statement
        $statement = Security::prepareStatement($this->db, $sql, $data, $types);
        if ($statement) {
            $statement->execute();
            if ($statement->error) {
                trigger_error($statement->error, E_USER_ERROR);
            } else {
                return true;
            }
        } else {
            trigger_error($statement->error, E_USER_ERROR);
        }
    }

    public function read($table = null, $column = "", $value = "") // allow flexibility like if u want to select from table multiple times or not?
    {
        $table = $table ?? $this->table;// if table wasn't passed use $this->table
    
        if (empty($table)) {
            trigger_error("Table isn't set", E_USER_ERROR);
        }
        //Check if table exists in database
        if (!$this->checkTable($table)) {
            trigger_error("Table: $table doesn't exist in database", E_USER_ERROR);
        }

        $out = [];
        $result = [];
        $statement = "";
        $type = "";
        if (empty($column)) {
            $sql = "SELECT * FROM $table;";
            $result = $this->db->query($sql);
        } else {
            if (!$this->checkColumns($column, $table)) {
                trigger_error("Column(s): $column do not exist", E_USER_ERROR);
            }
            if (is_int($value)) {
                $type .= "i";
            } else if (is_float($value)) {
                $type .= "d";
            } else if (is_string($value)) {
                $type .= "s";
            }
            $sql = "SELECT * FROM $table WHERE $column = ?";
            // Prepare statement
            $statement = Security::prepareStatement($this->db, $sql, $value, "s");
            if ($statement) {
                $statement->execute();
                if ($statement->error) {
                    trigger_error($statement->error, E_USER_ERROR);
                }
                $result = $statement->get_result();
            } else {
                trigger_error($statement->error, E_USER_ERROR);
            }
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
        }

        return ($out);
    }
    public function update($id, $data, $table = null)
    {
        $table = $table ?? $this->table; // // if table wasn't passed use $this->table
        $columns = implode(", ", array_keys($data));
        //If data is empty throw error
        if(empty($data)){
            trigger_error("No data passed to function", E_USER_ERROR);
        }
        
        if (empty($table)) {
            trigger_error("Table isn't set", E_USER_ERROR);
        }
        //Check if table exists in database
        if (!$this->checkTable($table)) {
            trigger_error("Table: $table doesn't exist in database", E_USER_ERROR);
        }
        //Check if columns exists in table
        if (!$this->checkColumns($columns, $table)) {
            trigger_error("Column(s): $columns do not exist in $table", E_USER_ERROR);
        }
        $sql = "UPDATE $table SET ";
        foreach ($data as $key => $value) {
            $sql .= "$key = ?, ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id = ?";
        $data['id'] = $id;
        $types = "";
        //Find data types
        foreach ($data as $key => $value) {
            if (is_int($value)) {
                $types .= "i";
            } else if (is_float($value)) {
                $types .= "d";
            } else if (is_string($value)) {
                $types .= "s";
            }
        }
        //Prepare statement
        $statement = Security::prepareStatement($this->db, $sql, $data, $types);
        if ($statement) {
            $statement->execute();
            if ($statement->error) {
                trigger_error($statement->error, E_USER_ERROR);
            } else {
                return true;
            }
        } else {
            trigger_error($statement->error, E_USER_ERROR);
        }
    }
    public function delete($id, $table = null)
    {
        $table = $table ?? $this->table; // if table wasn't passed use $this->table
        //Check if table exists in database
        if (empty($table)) {
            trigger_error("Table isn't set", E_USER_ERROR);
        }
        //Check if table exists in database
        if (!$this->checkTable($table)) {
            trigger_error("Table: $table doesn't exist in database", E_USER_ERROR);
        }
        $sql = "DELETE FROM $table WHERE id = ?";
        //Prepare statement
        $statement = Security::prepareStatement($this->db, $sql, $id, "i");
        if ($statement) {
            $statement->execute();
            if ($statement->error) {
                trigger_error($statement->error, E_USER_ERROR);
            } else {
                return true;
            }
        } else {
            trigger_error($statement->error, E_USER_ERROR);
        }
    }
}
