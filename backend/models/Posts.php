<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $post_id
 * @property string $post_title
 * @property string $post_content
 * @property integer $post_status
 * @property integer $post_author
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_title', 'post_content', 'post_author', 'post_category'], 'required'],
            [['post_content'], 'string'],
            [['post_status', 'post_author'], 'integer'],
            [['post_title', 'post_tags'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        
        return [
            'post_id' => 'Post ID',
            'post_title' => 'Titulo',
            'post_content' => 'Contenido',
            'post_status' => 'Estado',
            'post_tags' => 'Tags',
            'post_category' => 'Categoria',
            'post_author' => 'Post Author',
        ];
    }
}
