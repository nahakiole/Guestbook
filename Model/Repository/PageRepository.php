<?php


namespace Model\Repository;


use Model\Factory\PageFactory;

class PageRepository extends Repository {


    public function __construct($database){
        parent::__construct($database);
        $this->factory = new PageFactory();
    }

    /**
     * @param $limit
     * @param $offset
     *
     * @return \Model\Entity\Page[]
     */
    public function findAll($limit = 0, $offset = 0)
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param $id
     *
     * @return \Model\Entity\Page
     */
    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    /**
     * @param $filter \Model\Repository\Filter[]
     *
     * @return \Model\Entity\Page[]
     */
    public function findByFilter($filter)
    {
        $query = "SELECT `name`, `title`, `content`
                                             FROM `page`
                                             WHERE ".join('', $filter)."";
//        var_dump($query);
        $statement = $this->database->query($query);
        $pages = [];
        while($row = $statement->fetch(\PDO::FETCH_ASSOC)){
            $pages[] = $this->factory->build($row);
        }
        return $pages;
    }

    /**
     * @param $entity \Model\Entity\Page
     *
     * @return void
     */
    public function create($entity)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param $entity \Model\Entity\Page
     *
     * @return void
     */
    public function remove($entity)
    {
        // TODO: Implement remove() method.
    }
}