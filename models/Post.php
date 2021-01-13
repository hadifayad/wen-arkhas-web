<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $c_text
 * @property int $r_user
 * @property string|null $image
 *
 * @property Comment[] $comments
 * @property Likes[] $likes
 * @property Users $rUser
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
            [['image'], 'string', 'max' => 2000],
            [['r_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['r_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'c_text' => 'C Text',
            'r_user' => 'R User',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['r_post' => 'id']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::className(), ['r_post' => 'id']);
    }

    /**
     * Gets query for [[RUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'r_user']);
    }
}
