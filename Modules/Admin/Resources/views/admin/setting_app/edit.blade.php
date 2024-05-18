@extends('admin.layouts.app')

@section('content')


<section class="content">
<div class="row">
  @include('includes.messages')
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title" style="text-decoration: underline;color:brown">
              <div class="pull-left box-tools">
                {{$title}}
              </div>
                </h3>
            </div>
            <div class="box-body pad">
              <div class="box-body pad">
                <form @if (isset($result->id))
                        action="{{route('setting_app.update', $result->id ) }}"
                    @else
                        action="{{route('setting_app.store') }}"
                    @endif
                
                 method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else
                        
                    @endif
                    
                    <div class="form-group col-md-12 hidden">
                      <label> عدد الاعلانات المجانيه كل شهر</label>
                        <input type="number" min="0" name="num_free_advs" value="{{ @$result->num_free_advs }}" class="form-control"   />
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-md-12">سعر التوصيل</label>
                        <input type="number" min="1" name="delivery_price" value="{{ @$result->delivery_price }}"  class="form-control col-md-10"  />
                        <strong class="col-md-2">ريال </strong>
                    </div>
                    <div class="form-group col-md-12 hidden">
                        <label>سعر التمييز لمده ١٢ ساعة</label>
                        <input type="number" min="0" name="special_4_12h" value="{{ @$result->special_4_12h }}"  class="form-control"  />
                    </div>
                    <div class="form-group col-md-12 hidden">
                        <label>سعر التمييز لمدة يوم</label>
                        <input type="number" min="0" name="special_4_1day" value="{{ @$result->special_4_1day }}"  class="form-control"  />
                    </div>
                    <div class="form-group col-md-12 hidden">
                        <label>سعر التمييز لمدة يومان</label>
                        <input type="number" min="0" name="special_4_2day" value="{{ @$result->special_4_2day }}"  class="form-control"  />
                    </div>
                    
                    <div class="box-footer col-md-12">
                        <input type="submit" name="insert" class="btn btn-info pull-center" value="تعديـــــــل" />
                    </div>
                </form>    
              </div>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection
