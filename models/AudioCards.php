<?php 

require_once PATH_COMMON . 'db/Db.php';
require_once PATH_MODELS. 'Artists.php';
require_once PATH_MODELS. 'Images.php';

class AudioCards extends Db {
    public $table = 'audio_cards';

    /**
     * строка запроса для получения полной информации по аудио карточкам
     * @return string
     */
    private function getSqlFullInfo() {
        $artists =  new Artists();
        $images =  new Images();
        return  'select t1.*, t2.type, t2.blob, '
            . '(select name from ' . $artists->table .' as t3 where t3.id = t1.artist_id) as artist '
            . 'from '. $this->table. ' as t1 '
            . 'left join ' . $images->table. ' as t2 on t2.id = t1.image_id '
            . 'where t1.delete_at is null' ;
    }

    /**
     * Возвращает массив аудо карточек
     * @return array
     */
    public function getCards() {
        return $this->queryList($this->getSqlFullInfo(), [])->fetchAll();
    }

    public function save($data) {
        $connection = $this->getConnection();
        $sql = 'INSERT INTO ' . $this->table . '(`name`, `year`, `artist_id`, `code`, `duration`, `price`, `purchase_date`, `image_id`) '
                .'VALUES(:name, :year, :artist_id, :code, :duration, :price, :purchase_date, :image_id)';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':year', $data['year']);
        $stmt->bindParam(':artist_id', $data['artist_id']);
        $stmt->bindParam(':code', $data['code']);
        $stmt->bindParam(':duration', $data['duration']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':purchase_date', $data['purchase_date']);
        $stmt->bindParam(':image_id', $data['image_id']);
        $stmt->execute();
        return $connection->lastInsertId();
    }
}
