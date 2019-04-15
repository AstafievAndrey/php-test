<?php
abstract class Controller {
    /** редирект */
    public function redirect($route) {
        header('Location: index.php?r=' . $route);
    }
}