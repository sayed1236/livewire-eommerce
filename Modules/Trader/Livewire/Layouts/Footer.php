<?php

namespace Modules\Trader\Livewire\Layouts;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubscribeMail;

class Footer extends Component
{
    public $subemail,$erroremail;
    public function render()
    {
        $categories= Category::with('sub_category')->select('id','parent_id','name','img','img_nave')->whereType(0)->whereParentId(0)->get();

        return view('trader::livewire.layouts.footer',compact('categories'));
    }
    public function show_category($category_id){
        // dd($category_id);
        return redirect()->route('trader.category', $category_id);

    }
    public function subscribe(){
        $this->validate([
            'subemail'=> 'email|required'
        ]);

        $chk_email = SubscribeMail::where('email',$this->subemail)->first();
        if(empty($chk_email)){

        $subxcribeemail = new SubscribeMail();
            $subxcribeemail->email = $this->subemail;
            $subxcribeemail->save();
            $this->erroremail ='the email registered  ';

        }else{

            $this->erroremail ='this email already stored ';

        }
        $this->subemail='';
        // $this->erroremail='';
    }
}
