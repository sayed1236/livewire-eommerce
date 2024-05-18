<?php

namespace Modules\Vendors\Livewire\LegalAffairs;

use App\Models\Company;
use App\Models\Companydetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;



class Details extends Component
{
    use WithFileUploads;

    public $user,$id ,$name, $img, $mobile, $email, $comerical_lines,$comerical_lines_file,$taxes_licences,$taxes_licences_file,$started_date ,$brief,$company_profile,$accept_terms_condition;

    public function render()
    {
        if ( $this->user=Auth::guard('companies')->user()) {
            $this->user=Auth::guard('companies')->user();
            $this->id= $this->user->id;

            $this->name= $this->user->name;
            $this->mobile= $this->user->mobile;
            $this->email= $this->user->email;
            // dd($this->email);
            }
        return view('vendors::livewire.legal-affairs.details')->extends('vendors::components.layouts.app');
    }
    public function saving()
    {
        $this->validate([
            'name' => 'required|unique:products,name',
            'taxes_licences' => 'required',
            'taxes_licences_file' => 'required',
            'comerical_lines' => 'required',
            'comerical_lines_file' => 'required',
            'company_profile' => 'required',
            // 'image' => 'image|max:9924',

        ]);
        // dd($this->accept_terms_condition);
        if ($this->user=Auth::guard('companies')->user()) {
         $vendor=Company::where('id',Auth::guard('companies')->user()->id)->first();
         }
         $data= new Companydetail;
         // we eill add here company name
         $data->company_id=$vendor->id;
         $data->commercial_lines=$this->comerical_lines;
         if ($this->comerical_lines_file) {
            $file_name = $this->comerical_lines_file->getClientOriginalName();
            $path = $this->comerical_lines_file->storeAs('company_file', $file_name, 'public');
            $data->commercial_lines_file = '/storage/' . $path;

        }
        //  $data->commercial_lines_file=$this->comerical_lines_file;
         $data->taxes_licenses =$this->taxes_licences;
        //  $data->taxes_icenses_file=$this->taxes_licences_file;
         if ($this->taxes_licences_file) {
            $file_name = $this->taxes_licences_file->getClientOriginalName();
            $path = $this->taxes_licences_file->storeAs('company_file', $file_name, 'public');
            $data->taxes_icenses_file = '/storage/' . $path;

        }
        //  $data->started_date=$this->started_date;
         $data->brief=$this->brief;
        //  $data->company_profile=$this->company_profile;
         if ($this->company_profile) {
            $file_name = $this->company_profile->getClientOriginalName();
            $path = $this->company_profile->storeAs('company_file', $file_name, 'public');
            $data->file_of_profile = '/storage/' . $path;

        }
        if ($this->accept_terms_condition==true) {
            session()->flash('success_message', '   your legal information in revision we will contact with you soon .');
            // dd($data);
            $data->save();
        }
        else{
            // dd('err');

            session()->flash('error_message', ' please, complete all data...  .');

        }

    }

}
