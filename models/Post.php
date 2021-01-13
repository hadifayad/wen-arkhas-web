<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $c_text
 * @property int $r_user
 *
 * @property Comment[] $comments
 * @property Likes[] $likes
 * @property Users $rUser
 * @property PostImage[] $postImages
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_text', 'r_user'], 'required'],
            [['c_text'], 'string'],
            [['r_user'], 'integer'],
            [['r_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['r_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'c_text' => Yii::t('app', 'C Text'),
            'r_user' => Yii::t('app', 'R User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['r_post' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::className(), ['r_post' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'r_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostImages()
    {
        return $this->hasMany(PostImage::className(), ['r_post' => 'id']);
    }
}