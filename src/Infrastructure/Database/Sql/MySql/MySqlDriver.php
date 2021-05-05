<?php


namespace Fira\Infrastructure\Database\Sql\Mysql;


use Fira\Infrastructure\Database\Sql\AbstractSqlDriver;
require('/app/src/Infrastructure/Database/Sql/AbstractSqlDriver.php');
use mysqli;
use RuntimeException;

class MySqlDriver
{
    public function __construct(string $host, string $username, string $password, string $dbName, int $port)
    {
        $this->connection = new mysqli($host, $username, $password, $dbName, $port);
        $this->connection->select_db($dbName);
    }
    public function checkConnection() {
        if ($this->connection->connect_error) {
            return(false);
          }
          else {
              return(true);
          }
    }

    public function getRowById(int $id, string $table): array
    {
        $rows = $this->select(['*'], $table, 'id = ' . $id);
        if (empty($rows) || !isset($rows[0])) {
            throw new RuntimeException('Row with Id ' . $id . ' not found.');
        }

        return $rows[0];
    }

    public function select(array $field, string $table, string $where): array
    {
        if (empty($field)) {
            throw new RuntimeException('Fields should not be empty');
        }
        if (empty($table)) {
            throw new RuntimeException('Table should not be empty');
        }

        if (isset($field[0]) && $field[0] === '*') {
            $fieldString = '*';
        } else {
            $fieldString = implode(',', $field);
        }

        if($where === null) {
            $RealWhere = '';
        }
        else {
            $RealWhere = ' WHERE '.$where;
        }
        $query = "SELECT {$fieldString} FROM {$table} {$RealWhere};";

        $mysqlResult = $this->connection->query($query) OR throw new RuntimeException($query.' ');
        return $mysqlResult->fetch_array();
    }

    public function update(string $query): bool
    {
        $sql = $query;

        if ($conn->query($sql) === TRUE) {
            return(TRUE);
        } else {
            return(FALSE);
        }
    }

    public function delete(string $query): bool
    {
        if (empty($query)) {
            throw new RuntimeException('Empty Query');
        }
        $sql = $query;

        if ($this->connection->query($sql) === TRUE) {
            return(TRUE);
        } else {
            return(FALSE);
        }
    }

    public function insert(string $query): bool
    {
        if (empty($query)) {
            throw new RuntimeException('Empty Query');
        }
        $sql = $query;

        if ($this->connection->query($sql) === TRUE) {
            return(TRUE);
        } else {
            return(FALSE);
        }
    }
}