<?php


namespace Model\Repository;


abstract class Repository
{
    /**
     * @var $database \PDO
     */
    protected  $database;

    /**
     * @var $db \PDO
     */
    protected  $factory;

    /**
     * @internal param \PDO $database
     */
    public function __construct($database)
    {
        $this->database = $database;
    }

    /**
     * @param $limit
     * @param $offset
     *
     * @return \Model\Entity\Entity[]
     */
    abstract public function findAll($limit = 0, $offset = 0);

    /**
     * @param $id
     *
     * @return \Model\Entity\Entity
     */
    abstract public function findById($id);

    /**
     * @param $filter
     *
     * @return \Model\Entity\Entity
     */
    abstract public function findByFilter($filter);

    /**
     * @param $entity
     *
     * @return void
     */
    abstract public function create($entity);

    /**
     * @param $entity
     *
     * @return void
     */
    abstract public function remove($entity);

    /**
     * @param $entity
     *
     * @return void
     */
    abstract public function update($entity);
} 