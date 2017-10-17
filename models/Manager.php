<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "manager".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $wages
 * @property integer $is_active
 * @property integer $sort
 */
class Manager extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'wages'], 'required'],
            [['wages', 'is_active', 'sort'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'wages' => 'Wages',
            'is_active' => 'Is Active',
            'sort' => 'Sort',
        ];
    }

    /**
     * Возвращает конкатенацию фамилии и имени
     *
     * @return string
     */
    public function getFull_name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Связь таблицы manager и stat_manager_call
     *
     * @return StatManagerCall[]
     */
    public function getStat()
    {
        return $this->hasMany(StatManagerCall::className(), ['manager_id' => 'id'])
            ->andOnCondition(['between', 'date', date('Y-m-01'), date('Y-m-d')])
            ->orderBy(['date' => SORT_ASC]);
    }

    /**
     * Рассчитывает зп с учетом бонуса
     *
     * @return integer
     */
    public function getTotal_wages()
    {
        return $this->wages + array_sum($this->getBonus_history());
    }

    /**
     * История начисления бонусов по дням
     *
     * @return array $aResult
     */
    public function getBonus_history()
    {
        $aResult = []; $nSumCalls = 0; $nBonus = 0;

        $oBonus = Bonus::find()->select('step, value')->orderBy('step DESC')->all();
        $aBonus = ArrayHelper::map($oBonus, 'step', 'value');

        foreach($this->getStat()->all() as $day) {

            $nSumCalls += $day->calls;

            $nBonus = array_reduce($aBonus, function($max, $item) use($nSumCalls) {
                return ($nSumCalls < $item) ? $item : $max;
            });

            $aResult[$day->getDate_formatted()] = $day->calls * $nBonus;
        }

        return $aResult;
    }
}
