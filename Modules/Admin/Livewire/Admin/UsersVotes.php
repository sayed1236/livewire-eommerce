<?php

namespace Modules\Admin\Livewire\Admin;

use App\Models\UsersVote;
use App\Models\Vote;
use Livewire\Component;

class UsersVotes extends Component
{
    public $title_page,$vote_id,$showForm,$showDeleted,$btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($vote_id=0)
    {
        $this->vote_id=$vote_id;
        $gt_vote=Vote::find($this->vote_id);
        $this->title_page='Users Votes for:'.@$gt_vote->name_en;
        $this->showForm=false;
        $this->showDeleted=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';

    }
    public function render()
    {

        $results= UsersVote::whereVoteId($this->vote_id)->get()->sortByDesc('id');
        return view('livewire.admin.users-votes',
                    [
                        'results'=>$results,
                    ])->extends('admin.layouts.app',['script_datatables'=>true]);
    }

    public function edit_form($id=0)
    {
        $this->showForm=!$this->showForm;
        if($id > 0)
        {
            if($this->showForm == true)
            {
                $this->title_page=__('ms_lang.btn_edit');
                $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
            }
            else
            {
                $this->title_page=__('ms_lang.view');
                $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
            }
            $edit_object= UsersVote::where('deleted_at',null)->whereId($id)->first();
        }
        else
        {
            if($this->showForm == true)
            {
                $this->title_page=__('ms_lang.btn_add_new');
                $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
            }
            else
            {
                $this->title_page=__('ms_lang.view');
                $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
            }
            $add_object=new UsersVote();
            $edit_object=$add_object->get_new($this->type,$this->category_id);
        }
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }

    public function refresh_edited()
    {
        session()->flash('success_message','successfully updated');
        $this->showForm=false;
        $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
    }

    public function deleted()
    {
        $this->showDeleted=!$this->showDeleted;
        $this->showForm=false;
        $this->showFormEdit=false;
        if($this->showDeleted == true)
        {
            $this->title_page='Deleted Categories';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View Categories';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
    }

    public function win_user($id=0)
    {
        $data=UsersVote::select('id','is_win')->find($id);
        if($data->is_win == 'N')
        {
            $data->is_win='Y';
        }
        else
        {
            $data->is_win ='N';
        }
        $data->save();
        session()->flash('success_message','successfully updated');
    }

    public function delete_ms($id=0)
    {
        $data=UsersVote::select('id','deleted_at')->find($id);
        if($data->deleted_at == null)
        {
            $data->deleted_at=now();
        }
        else
        {
            $data->deleted_at =null;
        }
        $data->save();
    }
}
