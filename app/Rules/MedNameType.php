<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MedNameType implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->medicinesNames=[];
        $this->medicinesTypes=[];
        $this->medicines=[];
        $this->idx=0;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($attribute == 'med_name.'.$this->idx)
        {
            $this->medicinesNames []= $value;
            $this->idx++;
            return 1;
        } 
        else
        {
            $this->medicinesTypes[]=$value;
            if(count($this->medicinesNames) == count($this->medicinesTypes))
            {
              return $this->validate();  
            }
            return 1;
        }
        
        
    }
    
    private function validate()
    {
        foreach($this->medicinesNames as $key => $value)
        {
            if( isset($this->medicines[$value]) &&  $this->medicines[$value] ==$this->medicinesTypes[$key] )
            {
                return 0;
            }
            $this->medicines[$value]=$this->medicinesTypes[$key];

        }
        return 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Two or more Medicines have the same name and type';
    }
}
