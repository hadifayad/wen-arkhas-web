<?php

namespace app\controllers\api;

class MobileController extends ApiController {

    public function actionCreatePost() {
        return "asd";
        $post = Yii::$app->request->post();

        $text = $post["text"];
        return $text;
    }

}
