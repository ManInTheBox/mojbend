<?php

/**
 * Description of ActiveForm
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class ActiveForm extends CActiveForm
{
    public function dropDownList($model, $attribute, $data = array(), $htmlOptions = array())
    {
        if (empty ($data))
        {
            $table = str_replace('_id', '', $attribute);
            $data = Html::getListOptions($table);
        }
        if (!isset ($htmlOptions['prompt']))
        {
            $htmlOptions['prompt'] = t('Please choose...');
        }
        
        return parent::dropDownList($model, $attribute, $data, $htmlOptions);
    }
}