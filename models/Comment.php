<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $c_text
 * @property int $r_post
 * @property int $r_user
 * @property string $creation_date
 *
 * @property Post $rPost
 * @property Users $rUser
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_text', 'r_post', 'r_user'], 'required'],
            [['c_text'], 'string'],
            [['r_post', 'r_user'], 'integer'],
            [['creation_date'], 'safe'],
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
            'id' => 'ID',
            'c_text' => 'C Text',
            'r_post' => 'R Post',
            'r_user' => 'R User',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * Gets query for [[RPost]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'r_post']);
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
