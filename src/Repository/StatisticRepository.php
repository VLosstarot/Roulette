<?php

declare(strict_types=1);

namespace App\Repository;


use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Statement;
use \Doctrine\DBAL\Connection;


class StatisticRepository
{
    protected $conn;

    public function __construct(Connection $connection)
    {
        $this->conn = $connection;
    }

    /**
     * @return Statement|\Doctrine\DBAL\Statement
     * @throws DBALException
     */
    public function getRoundsStatistic()
    {
        $sql = 'SELECT * FROM round_statistic';
        $q = $this->conn->prepare($sql);
        $q->execute();

        return $q;
    }

    /**
     * @return Statement|\Doctrine\DBAL\Statement
     * @throws DBALException
     */
    public function getUsersStatistic()
    {
        $sql = 'SELECT * FROM user_statistic';
        $q = $this->conn->prepare($sql);
        $q->execute();

        return $q;
    }
}
