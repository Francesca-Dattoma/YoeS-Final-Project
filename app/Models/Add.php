<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Add extends Model
{
    use HasFactory, Searchable;
    public $asYouType = true;

    protected $fillable = [
        'title',
        'place',
        'price',
        'description',
        'user_id',
        'category_id',

    ];

     /**
     * Get the indexable data array for the model.
     *
     * @return array
     */

    

    public function toSearchableArray(){

        $category = $this->category;
        $array = [

            'id' => $this->id,
            'title' => $this->title,
            'place' => $this->place,
            'description' => $this->description,
            'category' => $category,            

        ];

        return $array;

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public static function toBeRevisionedCount(){
        return Add::where('is_accepted', null)->count();
    }

    public function setAccepted($value){
        $this->is_accepted = $value;
        $this->save();
        return true; 
    }

    public function images(){

        return $this->hasMany(Image::class);

    }

   
}

