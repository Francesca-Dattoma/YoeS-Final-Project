<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Add;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;

use App\Models\Announcement;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\File;



class CreateAdd extends Component
{
    use WithFileUploads;
    
    public $title;
    public $place;
    public $price;
    public $description;
    public $sortedCategories;
    public $temporary_images;
    public $images = [];
    public $image;
    public $add;
    public $user_id;
    public $form_id;
    


    public $category;
    protected $rules =[
        'title'=>'required|min:3|max:100',
        'place'=>'required|min:3|max:50',
        'price'=>'required|numeric',
        'description'=>'required|min:10',
        'category'=>'required|different:Placeholder', 
        'images.*'=> 'image|max:1024',
        'temporary_images.*'=> 'image|max:1024',
        'user_id'=>'required'
        
    ];

    protected $messages =[
        'required'=>'Il campo :attribute è obbligatorio',
        'min'=>'Il campo :attribute è troppo corto',
        'numeric'=>'Il campo :attribute richiede un numero',
        'max'=>'Il campo :attribute è troppo lungo',
        'temporary_images.required' => 'L\'immagine è richiesta',
        'temporary_images.*.image' => 'I file devono essere immagini',
        'temporary_images.*.max' => 'L\'immagine dev\'essere massimo di 1mb',
        'images.image' => 'Il file dev\'essere un\'immagine',
        'images.max' => 'Il file dev\'essere un\'immagine di 1mb'
        
    ];

    public function updatedTemporaryImages(){
        if($this->validate([
            'temporary_images.*'=>'image|max:1024',
        ])){
            foreach($this->temporary_images as $image){
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key){
        if(in_array($key, array_keys($this->images))){
            unset($this->images[$key]);
        }
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function store(){
        $this->user_id=Auth::user()->id;
        $this->validate();
       
        $this->add = Category::find($this->category)->adds()->create($this->validate());
        if(count($this->images)){
            foreach($this->images as $image){
                // $this->add->images()->create(['path'=>$image->store('images', 'public')]);
                $newFileName = "adds/{$this->add->id}";
                $newImage = $this->add->images()->create(['path'=>$image->store($newFileName, 'public')]);
            
                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 320, 320),
                   
                    new GoogleVisionSafeSearch($newImage->id),
                    
                    new GoogleVisionLabelImage($newImage->id),
                ])->dispatch($newImage->id);

            }


            File::deleteDirectory(storage_path('/app/livewire-tmp'));


        }


        







        // $category= Category::find($this->category);
        // $add=$category->adds()->create([

        //     'title'=>$this->title,
        //     'place'=>$this->place,
        //     'price'=>$this->price,2,
        //     'description'=>$this->description,       

        // ]);
        // Auth::user()->adds()->save($add);
        session()->flash('message', 'Annuncio correttamente inserito. Verrà revisionato da uno nostro collaboratore, attendi il messaggio di conferma.');
        $this->cleanForm();

    }

    public function cleanForm(){
        $this->title=''; 
        $this->place='';
        $this->price='';
        $this->description='';
        $this->category='';
        $this->image='';
        $this->images= [];
        $this->temporary_images = [];
        $this->form_id = rand();
    }

    public function render()
    {
        return view('livewire.create-add');
    }
}
