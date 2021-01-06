<?php

namespace app\controllers\api;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MobileController extends ApiController {

    public function actionSignup() {
        $post = Yii::$app->request->post();
        $fullname = $post["fullname"];
        $c_phone = $post["c_phone"];
        $email = $post["email"];
        $password = $post["password"];
        $username = $post["username"];

        $user = new \app\models\Users();
        $user->username = $username;
        $user->fullname = $fullname;
        $user->c_phone = $c_phone;
        $user->password = $password;
        $user->email = $email;
        if ($user->save()) {
            return true;
        }
    }
