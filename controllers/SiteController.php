<?php

require PATH_MODELS. 'AudioCards.php';

class SiteController {

    public function actionIndex() {
        $model = new AudioCards();
        return ['site/index', [
            'cards' => $model->getCards()
        ]];
    }

    public function actionAdd() {
        $model = new AudioCards();
        return ['site/add', []];
    }
}