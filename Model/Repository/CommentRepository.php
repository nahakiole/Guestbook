<?php

namespace Model\Repository;


use Model\Factory\CommentFactory;

class CommentRepository extends Repository
{

    public function __construct($database){
        parent::__construct($database);
        $this->factory = new CommentFactory();
    }

    /**
     * @param $limit
     * @param $offset
     *
     * @return \Model\Entity\Comment[]
     */
    public function findAll($limit = 0, $offset = 0)
    {
        $statement = $this->database->query("SELECT `name`, `place`, `mail`, `url`, `comment`, `date` FROM `Entry`");
        if($statement->rowCount() === 0){
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
     * @param $filter \Model\Repository\Filter[]
     *
     * @return \Model\Entity\Comment[]
     */
    public function findByFilter($filter)
    {
        $query = "SELECT `name`, `place`, `mail`, `url`, comment
                                             FROM `Entry`
                                             WHERE ".join('', $filter)."";
        //var_dump($query);
        $statement = $this->database->query($query);
        $comments = [];
        while($row = $statement->fetch(\PDO::FETCH_ASSOC)){
            $comments[] = $this->factory->build($row);
        }
        return $comments;
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