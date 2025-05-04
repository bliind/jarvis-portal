<?php

namespace App\Database;

class Database {
    private $pdo;
    protected $dsn;
    protected $username = null;
    protected $password = null;

    protected $table = '';
    protected $primaryKey = 'id';
    protected $select = 'SELECT *';
    protected $join = '';
    protected $where = '';
    protected $groupBy = '';
    protected $orderBy = '';
    protected $limit = '';

    /**
     * Initialize the PDO instance
     */
    public function __construct()
    {
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        ];

        $this->pdo = new \PDO($this->dsn, $this->username, $this->password, $options);
    }

    /**
     * Gets the columns available in the table
     *
     * @return array
     */
    protected function getColumns()
    {
        $sql = 'SELECT `COLUMN_NAME` FROM `information_schema`.`columns` WHERE `table_name` = :table';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':table', $this->table);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return array_map(function($item) { return $item->COLUMN_NAME; }, $result);
    }

    /**
     * Builds a query with the provided parts
     *
     * @param array $parts
     * @return string
     */
    protected function partsToQuery(array $parts = [])
    {
        // fall back on class properties
        $select  = isset($parts['select'])  ? $parts['select'] : $this->select;
        $join    = isset($parts['join'])    ? $parts['join'] : $this->join;
        $where   = isset($parts['where'])   ? $parts['where'] : $this->where;
        $orderBy = isset($parts['orderBy']) ? $parts['orderBy'] : $this->orderBy;
        $groupBy = isset($parts['groupBy']) ? $parts['groupBy'] : $this->groupBy;
        $limit   = isset($parts['limit'])   ? $parts['limit'] : $this->limit;

        return $select . ' FROM `' . $this->table . '`
            ' . $join . '
            ' . $where . '
            ' . $orderBy . '
            ' . $groupBy . '
            ' . $limit;
    }

    /**
     * Takes data to be inserted/updated in the db and cleans it up
     *
     * @param array $data
     * @return array
     */
    protected function cleanData(array $data)
    {
        $availableColumns = $this->getColumns();

        $loop = 0;
        $bind = $cols = [];
        foreach ($data as $column => $value) {
            // skip data if the column isn't in this table
            if (array_search($column, $availableColumns) === false) {
                continue;
            }

            // strip badness from value
            $value = trim(strip_tags($value));

            // set empty strings to null
            if ($value === '') {
                $value = null;
            }

            // turn ints into ints
            if (is_int($value)) {
                $value = intval($value);
            }

            // append to columns
            $columns[] = '`' . $column . '`';

            // append value to bind
            $bind[':bind' . $loop] = $value;

            $loop++;
        }

        return [$columns, $bind];
    }

    /**
     * Runs a select with the provided parts
     *
     * @param array $parts
     * @param array $bind
     * @return array
     */
    public function select(array $parts = [], array $bind = [])
    {
        $sql = $this->partsToQuery($parts);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($bind);

        return $stmt->fetchAll();
    }

    /**
     * Runs a select with the provided parts and returns a single result
     *
     * @param array $parts
     * @param array $bind
     * @return object
     */
    public function selectOne(array $parts = [], array $bind = [])
    {
        $sql = $this->partsToQuery($parts);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($bind);

        return $stmt->fetch();
    }

    /**
     * Inserts new data
     *
     * @param array $data
     * @return int
     */
    public function insert(array $data)
    {
        // clean the data and get the columns to insert and the data to be inserted
        [$columns, $bind] = $this->cleanData($data);


        // make and execute the query
        $sql = 'INSERT INTO `' . $this->table . '` (' . implode(',', $columns) . ') VALUES (' . implode(',', array_keys($bind)) . ');';
        $stmt = $this->pdo->prepare($sql);

        $out = false;
        if ($stmt->execute($bind)) {
            $out = $this->pdo->lastInsertId();
        }

        return $out;
    }

    /**
     * Updates a row
     *
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update(int $id, array $data)
    {
        // clean the data and get the columns to insert and the data to be inserted
        [$columns, $bind] = $this->cleanData($data);

        // start the query
        $sql = 'UPDATE `' . $this->table . '` SET ';

        $loop = 0;
        $count = count($bind);
        // add each column with its bind
        foreach ($bind as $bindName => $bindVal) {
            $sql .= $columns[$loop] . ' = ' . $bindName;
            if ($loop + 1 < $count) {
                $sql .= ',';
            }

            $sql .= ' ';
            $loop++;
        }

        // finish off the query
        $sql .= ' WHERE ' . $this->primaryKey . ' = :id';
        $bind[':id'] = $id;

        // execute it
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($bind);

        return $stmt->rowCount();
    }

    /**
     * Deletes a row from the DB based on the primary key
     *
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM `' . $this->table . '` WHERE ' . $this->primaryKey . ' = :id';
        $bind = [':id' => $id];

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($bind);

        return $stmt->rowCount();
    }

    /**
     * Gets a single result by ID
     *
     * @param int $id
     * @return object
     */
    public function get(int $id)
    {
        $parts = ['where' => 'WHERE id = :id'];
        $bind = [':id' => $id];

        return $this->selectOne($parts, $bind);
    }
}
