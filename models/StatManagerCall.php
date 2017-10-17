<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stat_manager_call".
 *
 * @property integer $id
 * @property string $date
 * @property integer $manager_id
 * @property integer $calls
 */
class StatManagerCall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stat_manager_call';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'manager_id'], 'required'],
            [['date'], 'safe'],
            [['manager_id', 'calls'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'manager_id' => 'Manager ID',
            'calls' => 'Calls',
        ];
    }

    /**
     * Форматирует дату
     *
     * @return date
     */
    public function getDate_formatted()
    {
        return date("d-m-Y", strtotime($this->date));
    }
}
