<?php

class DataBase
{
    /**
     * @var string|null
     */
    protected $host = 'databasehost';
    /**
     * @var string|null
     */
    protected $username = 'databasehost';

    /**
     * @var string|null
     */
    protected $password = 'databasehost';

    /**
     * @var string|null
     */
    protected $dbname = 'databasehost';

    /**
     * @var
     */
    protected $connection;

    /**
     * DataBase constructor.
     * @param null $host
     * @param null $username
     * @param null $password
     * @param null $dbname
     */
    public function __construct(
        $host = null,
        $username = null,
        $password = null,
        $dbname = null
    )
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    /**
     * @return mysqli
     */
    public function connect()
    {
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->username
        );

        if ($this->connection->connect_error) {
            die("Not Connected" . $this->connection->connect_error);
        }

        return $this->connection;
    }
}