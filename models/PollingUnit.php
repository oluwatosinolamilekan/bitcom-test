<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PollingUnit extends Model
{
    public $polling_unit_id;
    public $ward_id;
    public $lga_id;
    public $uniquewardid;
    public $polling_unit_number;
    public $polling_unit_name;
    public $polling_unit_description;
    public $enter_by_user;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // required fields
            [
                ['
                    polling_unit_id', 
                    'ward_id', 
                    'lga_id', 
                    'uniquewardid',
                    'polling_unit_number',
                    'polling_unit_name',
                    'polling_unit_description',
                    'enter_by_user',
                ], 
                'required'],
        ];
    }

    
}
