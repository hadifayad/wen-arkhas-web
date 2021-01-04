<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_image".
 *
 * @property int $id
 * @property string $c_image
 * @property int $r_post
 *
 * @property Post $rPost
 */
class PostImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_image', 'r_post'], 'required'],
            [['r_post'], 'integer'],
            [['c_image'], 'string', 'max' => 200],
            [['r_post'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['r_post' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'c_image' => Yii::t('app', 'C Image'),
            'r_post' => Yii::t('app', 'R Post'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'r_post']);
    }
}
