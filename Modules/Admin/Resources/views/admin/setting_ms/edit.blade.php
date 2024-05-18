@extends('admin::admin.layouts.app')

@section('content')
<div class="card card-custom">
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?><div class="text-muted pt-2 font-size-sm"></div></h3>
        </div>
    </div>
    <div class="card-body" style="overflow-x: auto;">
        <div class="col-md-6 offset-3" >
@include('admin::includes.messages')
        </div>

                <form @if (isset($result->id))
                        action="{{route('setting-page.update', $result->id ) }}"
                    @else
                        action="{{route('setting-page.store') }}"
                    @endif

                 method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else

                    @endif
                    <div class="card-body col-md-10 offset-1">
                        <div class="form-group row">
@if (isset($result->id) && !empty($result->img))
                    <div class="form-group  col-md-12 <?php //echo $dis_img; ?>">
                        <label for="ord">الصورة</label>
                        <img src="{{ img_chk_exist($result->img)}}" style="width: 70px; height: 60px" />
                    </div>
@endif
                        </div>
                        <div class="form-group row">
                <div class="form-group col-md-6">
                  <label for="Name">الاسم الموقع</label>
                    <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  />
                </div>
                <div class="form-group col-md-6">
                    <label for="name_en">Name EN</label>
                    <input type="text" name="name_en" value="{{ @$result->name_en }}" dir="ltr" class="form-control" id="name_en" placeholder=""  />
                </div>
                <div class="form-group col-md-3">
                  <label for="tel">الهاتف</label>
                  <input type="text" name="tel" value="{{ @$result->tel }}" dir="ltr" class="form-control"   />
                </div>
                <div class="form-group col-md-3">
                  <label for="mobile"> الجوال </label>
                  <input type="text" name="mobile" value="{{ @$result->mobile }}" dir="ltr" class="form-control"   />
                </div>
                <div class="form-group col-md-6 d-none">
                  <label for="mobile"> هاتف مصر</label>
                  <input type="text" name="mobile2" value="{{ @$result->mobile2 }}" dir="ltr" class="form-control"   />
                </div>
                <div class="form-group col-md-6">
                  <label for="whatsapp"> whatsapp </label>
                  <input type="text" name="whatsapp" value="{{ @$result->whatsapp }}" dir="ltr" class="form-control"   />
                </div>
                <div class="form-group col-md-6 d-none">
                  <label for="mobile">الفاكس</label>
                  <input type="text" name="fax" value="{{ @$result->fax }}" dir="ltr" class="form-control"   />
                </div>
                <div class="form-group col-md-6">
                  <label for="img">اللوجو</label>
                  <input type="file" name="img"  class="form-control"   />
                </div>
                <div class="form-group col-md-6">
                  <label for="email">الايميل</label>
                  <input type="text" name="email" value="{{ @$result->email }}" dir="ltr" class="form-control"   />
                </div>
                <div class="form-group col-md-6 d-none">
                  <label for="email_server">ايميل السيرفر</label>
                  <input type="text" name="email_server" value="{{ @$result->email_server }}" dir="ltr" class="form-control"   />
                </div>
                <div class="form-group col-md-12">
                  <label for="address">العنوان  </label>
                  <textarea name="address" class="form-control textarea_ms" dir="rtl"   placeholder="العنوان">{{ htmlspecialchars_decode($result->address) }}</textarea>
                </div>
                <div class="form-group col-md-12">
                  <label for="address">Address  </label>
                  <textarea name="address_en" class="form-control"  placeholder="address">{{ htmlspecialchars_decode($result->address_en) }}</textarea>
                </div>
                <div class="form-group col-md-12 d-none">
                  <label for="address">العنوان مكتب القاهرة</label>
                  <textarea name="address2" class="form-control textarea_ms" dir="rtl" placeholder="العنوان">{!! @$result->address2 !!}</textarea>
                </div>
                <div class="form-group col-md-12 d-none">
                  <label for="address">Address Cairo office</label>
                  <textarea name="address2_en" class="form-control textarea_ms"  placeholder="address">{!! @$result->address2_en !!}</textarea>
                </div>
                <div class="form-group  col-md-12 ">
                  <label for="details_en"> خريطة جوجل </label>
                  <textarea name="google_map" id="editor31" class="form-control" rows="5" dir="ltr"  placeholder="Enter ...">{!! $result->google_map !!}</textarea>
                </div>
                        </div>
                <div class="box-footer col-md-12">
                    <input type="submit" name="insert" class="btn btn-info pull-center" value="تعديـــــــل" />
                    <button type="button" onclick="history.go(-1);" class="btn btn-default">رجوع</button>
                  </div>
                    </div>
                </form>
    </div>
</div>
@endsection
