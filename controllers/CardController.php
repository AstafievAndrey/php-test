<?php
require_once PATH_COMMON. 'controller/Controller.php';

require_once PATH_MODELS. 'AudioCards.php';
require_once PATH_MODELS. 'Artists.php';
require_once PATH_MODELS. 'Images.php';


class CardController extends Controller{

    public function actionIndex() {
        $this->redirect('site/index');
    }

    public function actionDelete() {
        $card = new AudioCards();
        $id = filter_input(INPUT_GET, 'id');
        return ['type' => 'json', 'data' => ['res'=>$card->softDelete($id)]];
    }

    public function actionAdd() {
        $artists = new Artists();
        return ['card/add', [
            'artists' => $artists->all()
        ]];
    }

    public function actionSave() {
        $images =  new Images();
        $card = new AudioCards();
        $data = filter_input_array(INPUT_POST);
        $data['image_id'] = $images->save('image');
        $card->save($data);
        $this->redirect('site/index');
    }
}