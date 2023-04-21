<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasTranslations;
    protected $table = 'fees';
    public $timestamps = true;
    protected $guarded=[];
    public $translatable = ['title'];


    // علاقة المراحل الدراسية لجلب الاقسام المتعلقة بكل مرحلة

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
    }
}
