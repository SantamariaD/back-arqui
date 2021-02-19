<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cambio extends Model
{
    protected $table = 'cambios';
    protected $fillable = [
        'colornav', 'colorfoo','colortext', 'imgcarr1', 'imgcarr2', 'imgcarr3', 'textimg1','textimg2','textimg2','text1','text2','text3','text4','text5',
    ];
}
