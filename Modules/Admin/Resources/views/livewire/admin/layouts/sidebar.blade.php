<div>
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid"  style="background-color: {{ $special_data->color }}!important;color: {{ $special_data->second_color }}!important">
            <!--begin::Menu wrapper-->
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <a href="{{url(config('app.url_admin')) }}">
                        <div class="menu-item here show menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon"><i class="fa fa-home"></i></span>
                                <span class="menu-title">{{ __('ms_lang.home') }}</span>
                            </span>
                        </div>
                    </a>
                    <!--end:Menu item-->
<?php
use Spatie\Permission\Models\Permission;
if(count($pages_p)):
    foreach ($pages_p as $record_p):
        if($record_p->page_url=='' && $record_p->name=='الصفحات المقالية')
        {
?>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">{!!$record_p->img!!}</span>
                            </span>
                            <span class="menu-title">{{ Auth::user()->user_lang=='ar'? $record_p->name_ar: $record_p->name }}</span>
                            <i class="fa fa-angle-left pull-right"></i>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
            <?php
            // $pages_static= static_page::where('is_active',1)->get();
            foreach ($pages_static as $page_static):
            ?>
                            <div class="menu-item">
                                <a href="{{ route('static_page.show',$page_static->id)}}" class="menu-link">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{$page_static->name}}</span>
                                </a>
                            </div>
    <?php endforeach; ?>
                        </div>
                    </div>
        <?php
        }
        elseif($record_p->page_url=='category/t/0/4' && $record_p->name=='خدماتنا')
        {
        ?>
                    <div class="menu-item">
                        <a href="{{url(config('app.url_admin').$record_p->page_url) }}" class="menu-link {{ (request()->is('A_ms_admin/'.$record_p->page_url)) ? 'active' : '' }}">
                            <span class="svg-icon menu-icon">{!!$record_p->img!!}</span>
                            <span class="menu-title">{{ Auth::user()->user_lang=='ar'? $record_p->name_ar: $record_p->name }}</span>
                        </a>
                    </div>
        <?php
        }
        elseif($record_p->page_url=='' || $record_p->page_url=='#')
        {
            $pages_s= Permission::select($select)->where(['type'=>'page','parent_id'=>$record_p->id,'is_active'=>'Y'])->orderByRaw('ord ASC')->get();
            if(count($pages_s)):
        ?>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">{!!$record_p->img!!}</span>
                            </span>
                            <span class="menu-title">{{ Auth::user()->user_lang=='ar'? $record_p->name_ar: $record_p->name }}</span>
                            <i class="fa fa-angle-left pull-right"></i>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">

        <?php   foreach ($pages_s as $record_s): ?>
                            <div class="menu-item">
                                <a href="{{url(config('app.url_admin').$record_s->page_url)}}" class="menu-link {{ (request()->is('A_ms_admin/'.$record_p->page_url)) ? 'active' : '' }}">
                                    <span class="menu-bullet">{!!$record_s->img!!}</span>
                                    <span class="menu-title">{{$record_s->name}}</span>
                                </a>
                            </div>
        <?php   endforeach; ?>
                        </div>
                    </div>
        <?php
            endif;
        }
        elseif($record_p->parent_id ==0 && $record_p->page_url<>'')
        {
        ?>
                    <div class="menu-item">
                        <a href="{{url(config('app.url_admin').$record_p->page_url) }}" class="menu-link {{ (request()->is('A_ms_admin/'.$record_p->page_url)) ? 'active' : '' }}">
                            <span class="svg-icon menu-icon">{!!$record_p->img!!}</span>
                            <span class="menu-title">{{ Auth::user()->user_lang=='ar'? $record_p->name_ar: $record_p->name }}</span>
                        </a>
                    </div>
                    <?php
                                }
                            endforeach;
                    // }
                    ?>
<?php
endif;
?>
            </div>
        </div>
    </div>
</div>
