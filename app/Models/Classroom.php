<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    #علشان اعرفو ان انا هاستخدم الترجمة للاسم
    use HasTranslations;
    public $translatable =['Name_Class'];
    protected $table = 'classrooms';
    protected $guarded=[];
//    protected $fillable=['Name_Class','Grade_id'];

    use HasFactory;

    // علاقة بين الصفوف المراحل الدراسية لجلب اسم المرحلة في جدول الصفوف

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }
}
