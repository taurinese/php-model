<?php

namespace App\Models;

use Carbon\Carbon;

class Model
{

    function __construct()
    {
        foreach($this->dates as $date){
            if(isset($this->$date)){
                $this->$date = Carbon::parse($this->$date);
            }
        }
    }

}