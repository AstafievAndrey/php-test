<?php 

require_once PATH_COMMON . 'db/Db.php';

class Images extends Db {
    public $table = 'images';

    public function save($name) {
        $file = $_FILES[$name];
        $connection = $this->getConnection();
        $blob = fopen($file['tmp_name'], 'rb');

        $sql = 'INSERT INTO ' . $this->table . '(`name`, `type`, `size`, `blob`) '
                .'VALUES(:name, :type, :size, :blob)';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':name', $file['name']);
        $stmt->bindParam(':type', $file['type']);
        $stmt->bindParam(':size', $file['size']);
        $stmt->bindParam(':blob', $blob, PDO::PARAM_LOB);
        $stmt->execute();
        return $connection->lastInsertId();
    }
}
