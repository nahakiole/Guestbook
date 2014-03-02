<?php

namespace Model\Repository;


class Comment extends Repository
{

    public function __construct($database){
        parent::__construct($database);
        $this->factory = new \Model\Factory\Comment();
    }

    /**
     * @param $limit
     * @param $offset
     *
     * @return \Model\Entity\Comment[]
     */
    public function findAll($limit = 0, $offset = 0)
    {
        $statement = $this->database->query("SELECT * FROM `Entry`");
        if( $statement->rowCount() === 0){
            return [];
        }
        $comments = [];
        while($row = $statement->fetch(\PDO::FETCH_ASSOC)){
            $comments[] = $this->factory->build($row);
        }
        return $comments;
    }

    /**
     * @param $id
     *
     * @return \Model\Entity\Comment
     */
    public function findById($id)
    {
        // TODO: Implement findById() method.
    }


    /**
     * @param $filter
     *
     * @return \Model\Entity\Comment
     */
    public function findByFilter($filter)
    {
        // TODO: Implement findByFilter() method.
    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function create($entity)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function remove($entity)
    {
        // TODO: Implement remove() method.
    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function update($entity)
    {
        // TODO: Implement update() method.
    }
}