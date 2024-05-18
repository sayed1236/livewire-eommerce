<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
	<!--begin::Brand-->
	<div class="brand flex-column-auto" id="kt_brand" kt-hidden-height="65">
		<!--begin::Logo-->
		<a href="{{ url(config('app.url_admin')) }}"  class="brand-logo text-center">
		<img alt="Logo" src="{{ url('uploads/logo.png') }}" style="max-height:50px;max-width:130px" />
		</a>
		<!--end::Logo-->
		<!--begin::Toggle-->
		<button class="brand-toggle btn btn-sm px-0 active" id="kt_aside_toggle">
			<span class="svg-icon svg-icon svg-icon-xl">
				<!--begin::Svg Icon | path:media/svg/icons/Navigation/Angle-double-left.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
						<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</button>
		<!--end::Toolbar-->
	</div>
	<!--end::Brand-->
	<!--begin::Aside Menu-->
	<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
		<!--begin::Menu Container-->
		<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
			<!--begin::Menu Nav-->
			<ul class="menu-nav">

				<?php
				$select=Auth::user()->user_lang=='ar'? array("id","name_ar as name", "parent_id","page_url","img"):array("id","name", "parent_id","page_url","img");
				use Spatie\Permission\Models\Permission;
				use App\Models\static_page;
				use App\Models\Admin\User;
				//use App\Models\permissions_users_type;
				$user_id=Auth::id();
				$user=User::with('permissions','roles')->find($user_id);
				$pages_p=$user->getPermissionsViaRoles();
				//$pages_p=Permission::select($select)->where(['type'=>'page','parent_id'=>0,'is_active'=>'Y'])->orderBy('ord', 'ASC')->get();
				if(count($pages_p)):
					foreach ($pages_p as $record_p):
						if($record_p->page_url=='' && $record_p->name=='الصفحات المقالية')
						{
				?>
							<li class="treeview">
								<a href="#">{!!$record_p->img!!}<span>{{ Auth::user()->user_lang=='ar'? $record_p->name_ar: $record_p->name }}</span> <i class="fa fa-angle-left pull-right"></i></a>
								<ul class="treeview-menu">
				<?php
				$pages_static= static_page::where('is_active',1)->get();
				foreach ($pages_static as $page_static): ?>
									<li class="menu-item" aria-haspopup="true">
										<a  href="{{ route('static_page.show',$page_static->id)}}" class="menu-link">
											<i class="menu-bullet menu-bullet-dot"><span></span></i>
											<span class="menu-text">{{$page_static->name}}</span>
										</a>
									</li>
				<?php endforeach; ?>
							  </ul>
							</li>
				<?php
							}
							elseif($record_p->page_url=='category/t/0/4' && $record_p->name=='خدماتنا')
							{
				?>
							 <li class="menu-item" aria-haspopup="true">
								<a  href="{{url(config('app.url_admin').$record_p->page_url)}}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot"><span></span></i>
									<span class="menu-text">{{ Auth::user()->user_lang=='ar'? $record_p->name_ar: $record_p->name }}</span>
								</a>
							</li>
				<?php
							}
							elseif($record_p->page_url=='' || $record_p->page_url=='#')
							{
								$pages_s= Permission::select($select)->where(['type'=>'page','parent_id'=>$record_p->id,'is_active'=>'Y'])->orderByRaw('ord ASC')->get();
								if(count($pages_s)):
				?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="javascript:;" class="menu-link menu-toggle">
									<span class="svg-icon menu-icon"> {!!$record_p->img!!} </span>
									<span class="menu-text">{{ Auth::user()->user_lang=='ar'? $record_p->name_ar: $record_p->name }}</span>
									<i class="menu-arrow"></i>
								</a>
								<div class="menu-submenu">
									<i class="menu-arrow"></i>
									<ul class="menu-subnav">
							  <?php foreach ($pages_s as $record_s): ?>
										<li class="menu-item menu-item-{{ (request()->is('A_ms_admin/'.$record_p->page_url)) ? 'active' : '' }}" aria-haspopup="true">
												<a href="{{url(config('app.url_admin').$record_s->page_url)}}" class="menu-link">
													{!!$record_s->img!!}
													<span class="menu-text">{{$record_s->name}}</span>
												</a>
											</li>
							  <?php endforeach; ?>
										</ul>
									</div>
								</li>
				<?php
								endif;
							}
							elseif($record_p->parent_id ==0 && $record_p->page_url<>'')
							{
				?>
								<li class="menu-item menu-item-{{ (request()->is('A_ms_admin/'.$record_p->page_url)) ? 'active' : '' }}" aria-haspopup="true">
									<a  href="{{url(config('app.url_admin').$record_p->page_url) }}" class="menu-link">
									<span class="svg-icon menu-icon">{!!$record_p->img!!}</span>
										<span class="menu-text">{{ Auth::user()->user_lang=='ar'? $record_p->name_ar: $record_p->name }}</span>
									</a>
								</li>
				<?php
							}
						endforeach;
				   // }
				?>
				<?php
				endif;

				?>
					  </ul>
					  <!--end::Menu Nav-->
				  </div>
				  <!--end::Menu Container-->
				</div>
				<!--end::Aside Menu-->
				</div>
				<!--end::Aside-->