<?php

abstract class Db {

    /**
     * Возвращаем PDO объект
     */
    protected function getConnection() {
        global $config;
        $connection = new PDO(
            $config['db']['dsn'] . ';charset=' . $config['db']['charset'],
            $config['db']['username'],
            $config['db']['password']
        );
        return $connection;
    }

    /**
     * вернем sql на выборку записей из бд
     * @return string
     */
    protected function getSql() {
        return 'select * from ' . $this->table . ' where delete_at is null ';
    }

    /**
     * вернем подготовленный запрос к базе данных
     * @return PDOStatement
     */
    protected function queryList($sql, $args){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    /**
     * 'мягкое' удаление записи помечаем запись в бд как удаленную
     * @var integer $id ид записи
     * @return boolean
     */
    public function softDelete($id) {
        $connection = $this->getConnection();
        $stmt = $connection->prepare('update ' . $this->table . ' set delete_at = NOW() where id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     *  веренем запись в бд
     * @var integer $id ид записи
     * @return array
     */
    public function findOne($id) {
        return $this->queryList(
            $this->getSql(). ' and id = '. (int) $id, []
        )->fetch();
    }

    /**
     *  веренем записи из бд
     * @var integer $limit 
     * @var integer $offset
     * @return array
     */
    public function all($limit = null, $offset = 0) {
        $sql = $this->getSql();
        if (!is_null($limit)) {
            $sql .= 'LIMIT ' . (int) $limit . ' OFFSET' . (int) $offset;
        }
        return $this->queryList($sql, [])->fetchAll();
    }
}