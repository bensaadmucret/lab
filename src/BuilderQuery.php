<?php
declare(strict_types=1);

namespace App;

class QueryBuilder
{
    private $query;

    public function __construct()
    {
        $this->query = new stdClass();
        $this->query->select = [];
        $this->query->from = null;
        $this->query->where = [];
        $this->query->join = [];
        $this->query->groupBy = [];
        $this->query->orderBy = [];
        // Ajoutez d'autres propriétés nécessaires pour les autres clauses SQL
    }

    public function select(...$columns)
    {
        $this->query->select = array_merge($this->query->select, $columns);
        return $this;
    }

    public function from($table)
    {
        $this->query->from = $table;
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->query->where[] = [$column, $operator, $value];
        return $this;
    }

    public function join($table, $column1, $operator, $column2)
    {
        $this->query->join[] = [$table, $column1, $operator, $column2];
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->query->orderBy[] = [$column, $direction];
        return $this;
    }

    public function groupBy(...$columns)
    {
        $this->query->groupBy = array_merge($this->query->groupBy, $columns);
        return $this;
    }

    public function build()
    {
        $sql = "SELECT " . implode(", ", $this->query->select);
        $sql .= " FROM " . $this->query->from;

        if (!empty($this->query->join)) {
            foreach ($this->query->join as $join) {
                $sql .= " JOIN {$join[0]} ON {$join[1]} {$join[2]} {$join[3]}";
            }
        }

        if (!empty($this->query->where)) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($this->query->where as $where) {
                $conditions[] = "{$where[0]} {$where[1]} '{$where[2]}'";
            }
            $sql .= implode(" AND ", $conditions);
        }

        if (!empty($this->query->groupBy)) {
            $sql .= " GROUP BY " . implode(", ", $this->query->groupBy);
        }

        if (!empty($this->query->orderBy)) {
            $sql .= " ORDER BY ";
            $orders = [];
            foreach ($this->query->orderBy as $order) {
                $orders[] = "{$order[0]} {$order[1]}";
            }
            $sql .= implode(", ", $orders);
        }

        // Ajoutez la logique pour les autres clauses SQL

        return $sql;
    }
}
