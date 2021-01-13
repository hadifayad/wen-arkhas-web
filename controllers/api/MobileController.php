<?php

namespace app\controllers\api;

use app\models\Users;
use Yii;

class MobileController extends ApiController {

    public function actionCreatePost() {
        return "asd";
        $post = Yii::$app->request->post();

        $text = $post["text"];
        return $text;
    }

    public function actionSignup() {

        $post = Yii::$app->request->post();
        $fullname = $post["fullname"];
        $c_phone = $post["c_phone"];
        $email = $post["email"];
        $password = $post["password"];
        $username = $post["username"];


        //return $post;
        $user = new Users();
        $user->username = $username;
        $user->fullname = $fullname;
        $user->c_phone = $c_phone;
        $user->password = $password;
        $user->email = $email;
//
//        $user = new Users();
//        $user->username = "hadifd";
//        $user->fullname = "hadifd";
//        $user->c_phone = "7171";
//        $user->password = "pass";
//        $user->email = "email";
        $user->save();
        if ($user->save()) {
            return true;
        } else
            return "faileddd";
    }

    public function actionLogin() {

        $post = Yii::$app->request->post();
        $username = $post["username"];
        $password = $post["password"];

        $user = Users::find()
                ->where(["username" => $username])
                ->andWhere(["password" => $password])
                ->one();
        if ($user) {
            return $user;
        } else
            return false;
    }

}
