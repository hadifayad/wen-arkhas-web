<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\api;

use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Description of BaseController
 *
 * @author user
 */
class ApiController extends Controller {

    public function beforeAction($action) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

}
