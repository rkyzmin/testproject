<?php

namespace base;

require_once("config/db.php");

class Database
{
    protected $table = '';
    private $connect = null;

    public function __construct()
    {
        $this->connection();
    }

    private function connection()
    {
        try {
            $this->connect = mysqli_connect(DB_HOST, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME);
            mysqli_set_charset($this->connect, 'utf8');
        } catch (\Exception $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }

    public function show($fields = [], $where = [])
    {
        $whereQuery = '';
        $fields = implode(', ', $fields);
        $items = [];

        if (!empty($where)) {
            $whereQuery = ' WHERE ';

            foreach ($where as $key => $field) {
                $whereQuery .= $key . ' = ' . "'" . $field . "'";
                $whereQuery .= ' AND ';
            }

            $whereQuery = substr($whereQuery, 0, -5);
        }

        $query = "SELECT $fields FROM $this->table";

        if ($whereQuery !== null) {
            $query .= $whereQuery;
        }

        $result = $this->connect->query($query);

        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }

    public function add($fields = [], $values = [])
    {
        $table = $this->table;
        $fields = implode(', ', $fields);
        $values = implode("', '", $values);

        $query = "INSERT INTO $table($fields) VALUES('$values')";
        // echo $query;

        if ($this->connect->query($query)) {
            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 503]);
        }
        return;
    }

    public function update($fields = [], $where = null)
    {
        $table = $this->table;
        $fieldsString = '';

        foreach ($fields as $key => $field) {
            $fieldsString .= $key . ' = ' . "'" . $field . "'";
            $fieldsString .= ', ';
        }

        $fieldsString = substr($fieldsString, 0, -2);
        $query = "UPDATE $table SET $fieldsString WHERE id = $where";

        if ($this->connect->query($query)) {
            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 503]);
        }
        return;
    }

    public function delete($where = '')
    {
        $table = $this->table;
        $query = "DELETE FROM $table WHERE $where";

        if ($this->connect->query($query)) {
            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 503]);
        }
        return;
    }
}
