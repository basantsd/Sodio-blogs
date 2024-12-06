<?php

namespace App\Core;

use Exception;
use PDO;
use PDOException;

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Utility method to build WHERE clause with AND / OR
    protected function buildWhereClause($conditions = []) {
        if (empty($conditions)) {
            return "";
        }
        
        $clauses = [];
        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                // Handling conditions with specific operators
                foreach ($value as $operator => $val) {
                    $placeholder = ":" . str_replace('.', '_', $field) . "_" . str_replace(' ', '_', $operator);
                    $clauses[] = "$field $operator $placeholder";
                    $params[$placeholder] = $val;
                }
            } else {
                // Standard equality
                $placeholder = ":" . str_replace('.', '_', $field);
                $clauses[] = "$field = $placeholder";
                $params[$placeholder] = $value;
            }
        }
        return "WHERE " . implode(' AND ', $clauses);
    }
    

    protected function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            foreach ($params as $key => $value) {
                if ($key === 'limit' || $key === 'offset') {
                    $stmt->bindValue(':' . $key, $value, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue(':' . $key, $value);
                }
                // $stmt->bindValue(':' . $key, $value);
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            error_log('Database query error: ' . $e->getMessage());
            throw new Exception("Database query error, please try again later.");
        }
        
    }

    public function get($conditions = [], $order_by = [], $limit = null, $offset = null) {
        $sql = "SELECT * FROM {$this->table}";
        $params = [];
    
        if (!empty($conditions)) {
            $whereClause = $this->buildWhereClause($conditions);
            $sql .= " $whereClause";
            $params = $conditions;
        }
    
        if (!empty($order_by) && isset($order_by['column']) && isset($order_by['direction'])) {
            $sql .= " ORDER BY {$order_by['column']} {$order_by['direction']}";
        }
    
        if ($limit !== null) {
            $sql .= " LIMIT :limit";
            $params['limit'] = $limit;
    
            if ($offset !== null) {
                $sql .= " OFFSET :offset";
                $params['offset'] = $offset;
            }
        }
    
        $stmt = $this->executeQuery($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    // Find record by conditions
    public function find($conditions) {
        $whereClause = $this->buildWhereClause($conditions);
        $sql = "SELECT * FROM {$this->table} $whereClause LIMIT 1";
        $stmt = $this->executeQuery($sql, $conditions);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert a new record
    public function insert($data) {
        $currentTimestamp = date('Y-m-d H:i:s');
        $data['created_at'] = $currentTimestamp;
        $data['updated_at'] = $currentTimestamp;
        $keys = array_keys($data);
        $values = array_map(function($key) { return ":$key"; }, $keys);
        $sql = "INSERT INTO {$this->table} (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $values) . ")";
        $this->executeQuery($sql, $data);
        return $this->db->lastInsertId();
    }

    // Update records based on conditions
    public function update($conditions, $data) {
        $currentTimestamp = date('Y-m-d H:i:s');
        $data['updated_at'] = $currentTimestamp;
        $whereClause = $this->buildWhereClause($conditions);
        $sets = array_map(function($key) { return "$key = :$key"; }, array_keys($data));
        $sql = "UPDATE {$this->table} SET " . implode(', ', $sets) . " $whereClause";
        $this->executeQuery($sql, array_merge($data, $conditions));
    }

    // Delete records based on conditions
    public function delete($conditions) {
        $whereClause = $this->buildWhereClause($conditions);
        $sql = "DELETE FROM {$this->table} $whereClause";
        $this->executeQuery($sql, $conditions);
    }

    // Count records based on conditions
    public function count($conditions = []) {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        $params = [];
    
        if (!empty($conditions)) {
            $whereClause = $this->buildWhereClause($conditions);
            $sql .= " $whereClause";
            $params = $conditions;
        }
        $stmt = $this->executeQuery($sql, $params);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        return $result[0];  
    }
    
}
