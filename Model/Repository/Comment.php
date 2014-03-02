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
        $statement = $this->database->query("SELECT `name`, `place`, `mail`, `url`, comment FROM `Entry`");
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
        $statement = $this->database->query("SELECT `name`, `place`, `mail`, `url`, comment FROM `Entry` WHERE `id` = ".intval($id));
        $comments = null;
        while($row = $statement->fetch(\PDO::FETCH_ASSOC)){
            $comments = $this->factory->build($row);
        }
        return $comments;
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

}