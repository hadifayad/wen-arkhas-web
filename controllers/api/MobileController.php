<?php

namespace app\controllers\api;

use app\models\Post;
use Yii;

class MobileController extends ApiController {

    public function actionCreatePost() {
        $post = Yii::$app->request->post();
        $text = $post["text"];
        $image = $post["image"];
        $user = 1;

        $post = new Post();
        $post->r_user = $user;
        $post->c_text = $text;
        if ($post->save()) {
            if (!file_exists(\Yii::getAlias('@webroot/imagesposts'))) {
                mkdir(\Yii::getAlias('@webroot/imagesposts'), 0777, true);
            }
            if ($image != "" && $image != null && $image) {
                $uploads_dir = \Yii::getAlias('@webroot/imagesposts/');
                $imageName = Yii::$app->security->generateRandomString() . ".jpeg";
                $percent = 0.5;

                $data = base64_decode($image);
                $im = imagecreatefromstring($data);
                $width = imagesx($im);
                $height = imagesy($im);
                $newwidth = $width * $percent;
                $newheight = $height * $percent;
                $thumb = imagecreatetruecolor($newwidth, $newheight);

//                            header('Content-type: image/jpeg');
                // Resize
                imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                // Output
                imagejpeg($thumb, $uploads_dir . $imageName);

                $post2 = Post::findOne(["id" => $post->primaryKey]);
                $post2->image = $imageName;
                if ($post2->save()) {

                } else {
                    return $post2->errors;
                }
            }
        } else {
            return $post->errors;
        }
        return "success";
    }

    public function actionGetPosts() {

        $posts = Post::find()
                ->orderBy("creation_date DESC")
                ->asArray()
                ->all();

        return $posts;
    }

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
        } else
            return false;
    }

    public function actionLogin() {
        $post = Yii::$app->request->post();

        $password = $post["password"];
        $username = $post["username"];

        $user = \app\models\Users::find()
                ->where(['username' => $username])
                ->andWhere(['password' => $password])
                ->one();
        if ($user)
            return $user;
        else
            return false;
    }

}
