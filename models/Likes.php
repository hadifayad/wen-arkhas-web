<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "likes".
 *
 * @property int $id
 * @property int $r_post
 * @property int $r_user
 * @property string $c_type
 *
 * @property Post $rPost
 * @property Users $rUser
 */
class Likes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'likes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['r_post', 'r_user', 'c_type'], 'required'],
            [['r_post', 'r_user'], 'integer'],
            [['c_type'], 'string', 'max' => 200],
            [['r_post'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['r_post' => 'id']],
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
            'r_post' => Yii::t('app', 'R Post'),
            'r_user' => Yii::t('app', 'R User'),
            'c_type' => Yii::t('app', 'C Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'r_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'r_user']);
    }
}
