<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\Admin\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Guard;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gaurd_name=Guard::getDefaultName(static::class);
        $p5=Permission::create(
            array(
                'type' => "page",
                'parent_id' => 0,
                'name_ar' => 'الاقسام',
                'name' => 'Categories',
                'guard_name' => $gaurd_name,
                'page_url' => 'category/0/0',
                'img' => '<i class="fa fa-fw fa-rss text-success"></i>',
                'is_active' => 'Y',
            )
        );
            Permission::create(
                array('type' => "action", 'parent_id' => $p5->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
            );
            Permission::create(
                array('type' => "action", 'parent_id' => $p5->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
            );
            Permission::create(
                array('type' => "action", 'parent_id' => $p5->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
            );
            Permission::create(
                array('type' => "action", 'parent_id' => $p5->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
            );
        // $p0=Permission::create(
        //     array(
        //         'type' => "page",
        //         'parent_id' => 0,
        //         'name_ar' => 'انواع المستخدمين',
        //         'name' => 'roles',
        //         'guard_name' => $gaurd_name,
        //         'page_url' => 'roles',
        //         'img' => '<i class="fa fa-fw fa-users text-info"></i>',
        //         'is_active' => 'Y',
        //     )
        // );
        //     Permission::create(
        //         array('type' => "action", 'parent_id' => $p0->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
        //     );
        //     Permission::create(
        //         array('type' => "action", 'parent_id' => $p0->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
        //     );
        //     Permission::create(
        //         array('type' => "action", 'parent_id' => $p0->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
        //     );
        //     Permission::create(
        //         array('type' => "action", 'parent_id' => $p0->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
        //     );
    // $p00=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'الصلاحيات',
    //             'name' => 'premissions',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'permissions',
    //             'img' => '<i class="fa fa-fw fa-users text-info"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p00->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p00->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p00->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p00->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );

        // $p1=Permission::create(
        //     array(
        //         'type' => "page",
        //         'parent_id' => 0,
        //         'name_ar' => 'مديرين الموقع',
        //         'name' => 'Admin Users',
        //         'guard_name' => $gaurd_name,
        //         'page_url' => 'users/0/7',
        //         'img' => '<i class="fa fa-fw fa-users text-warning"></i>',
        //         'is_active' => 'Y',
        //     )
        // );
        //     Permission::create(
        //         array('type' => "action", 'parent_id' => $p1->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
        //     );
        //     Permission::create(
        //         array('type' => "action", 'parent_id' => $p1->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
        //     );
        //     Permission::create(
        //         array('type' => "action", 'parent_id' => $p1->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
        //     );
        //     Permission::create(
        //         array('type' => "action", 'parent_id' => $p1->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
        //     );

    // $p2=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'الاعضاء',
    //             'name' => 'Members',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'users/0/1',
    //             'img' => '<i class="fa fa-fw fa-users text-info"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p2->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p2->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p2->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p2->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p3=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'الطلاب',
    //             'name' => 'Students',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'users/0/2',
    //             'img' => '<i class="fa fa-fw fa-users text-success"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p3->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p3->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p3->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p3->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p4=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'اؤلياء الامور',
    //             'name' => 'Parents',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'users/0/3',
    //             'img' => '<i class="fa fa-fw fa-users text-danger"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p4->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p4->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p4->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p4->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    $p44=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => 'الالوان والمقاسات',
                    'name' => 'attributes',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'attribute/t/1',
                    'img' => '<i class="fab fa-audible text-info"></i>',
                    'is_active' => 'Y',
                )
            );
            $p45=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => 'المنتجات',
                    'name' => 'products
                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'products',
                    'img' => '<i class="fab fa-product-hunt text-info"></i>',
                    'is_active' => 'Y',
                )
            );
            $p46=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => 'المقالات',
                    'name' => 'articals
                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'art-mins/0/0',
                    'img' => '<i class="fas fa-book-open text-info"></i>',
                    'is_active' => 'Y',
                )
            );
            $p47=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => 'البلوجات',
                    'name' => 'blogs
                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'static_pages/1',
                    'img' => '<i class="fab fa-blogger text-info"></i>',
                    'is_active' => 'Y',
                )
            );
            $p48=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => ' الطلبات الجديده',
                    'name' => 'new-orders

                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'new-orders',
                    'img' => '<i class="fa fa-fw fa-cart-arrow-down text-success"></i>',
                    'is_active' => 'Y',
                )
            );
            $p49=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => '   الطلبات الجاري تحضيرها',
                    'name' => 'working-orders


                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'working-orders',
                    'img' => '<i class="fa fa-fw fa-cart-arrow-down text-warning"></i>',
                    'is_active' => 'Y',
                )
            );
            $p50=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => ' الطلبات الجاري توصيلها',
                    'name' => 'delivering-orders
                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'delivering-orders',
                    'img' => '<i class="fa fa-fw fa-cart-arrow-down text-info"></i>',
                    'is_active' => 'Y',
                )
            );
            $p51=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => '  الطلبات التي تم توصيلها  ',
                    'name' => 'delivered-orders

                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'delivered-orders',
                    'img' => '<i class="fa fa-fw fa-cart-arrow-down text-danger"></i>',
                    'is_active' => 'Y',
                )
            );
            $p52=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => '    الطلبات المنتهيه    ',
                    'name' => 'finshed-orders


                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'finshed-orders',
                    'img' => '<i class="fa fa-fw fa-cart-arrow-down text-purple"></i>',
                    'is_active' => 'Y',
                )
            );
            $p53=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => ' صور الاسلايدر    ',
                    'name' => 'sliders


                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'gallery/0',
                    'img' => '<i class="fas fa-photo-video"></i>',
                    'is_active' => 'Y',
                )
            );
           
            $p54=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => ' المحافظات والمناطق     ',
                    'name' => 'Cities & Regions


                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'countries_cities/0',
                    'img' => '<i class="fas fa-globe text-success"></i>',
                    'is_active' => 'Y',
                )
            );
            $p55=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => ' الكوبونات      ',
                    'name' => 'Coupons
                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'coupons',
                    'img' => '<i class="fas fa-rss text-warning"></i>',
                    'is_active' => 'Y',
                )
            );
            $p55=Permission::create(
                array(
                    'type' => "page",
                    'parent_id' => 0,
                    'name_ar' => '  الطلبات الملغاه      ',
                    'name' => 'canceled orders
                    ',
                    'guard_name' => $gaurd_name,
                    'page_url' => 'canceled-orders',
                    'img' => '<i class="fa fa-fw fa-cart-arrow-down text-danger"></i>',
                    'is_active' => 'Y',
                )
            );
    //             Permission::create(
    //                 array('type' => "action", 'parent_id' => $p44->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //             );
    //             Permission::create(
    //                 array('type' => "action", 'parent_id' => $p44->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //             );
    //             Permission::create(
    //                 array('type' => "action", 'parent_id' => $p44->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //             );
    //             Permission::create(
    //                 array('type' => "action", 'parent_id' => $p44->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //             );
   
    // $p6=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'المراحل الدراسيه',
    //             'name' => 'School Grades',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'attributes/0',
    //             'img' => '<i class="fa fa-fw fa-rss text-warning"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p6->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p6->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p6->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p6->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p61=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'الفصول المدرسيه',
    //             'name' => 'Classrooms',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'products/0/0',
    //             'img' => '<i class="icon-xl fas fa-folder-plus text-danger"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p61->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p61->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p61->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p61->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p62=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'المواد المدرسيه',
    //             'name' => 'school subjects',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'products/0/0',
    //             'img' => '<i class="icon-xl fas fa-folder-plus text-danger"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p62->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p62->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p62->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p62->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p7=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'الصفحات المقاليه',
    //             'name' => 'Static pages',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => '',
    //             'img' => '<i class="fa fa-fw fa-text-width text-success"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p7->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p7->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p7->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p7->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p8=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'المحافظات',
    //             'name' => 'Cities',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'countries_cities/2',
    //             'img' => '<i class="icon-xl fas fa-globe text-info"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p8->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p8->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p8->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p8->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p81=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'السلايدر',
    //             'name' => 'slider',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'art-mins/0/0',
    //             'img' => '<i class="icon-xl fas fa-globe text-info"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p81->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p81->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p81->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p81->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p9=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'الاشعارات',
    //             'name' => 'Notifications',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => '',
    //             'img' => '<i class="ficon-xl fas fa-volume-up text-danger"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         $p99=Permission::create(
    //             array(
    //                 'type' => "page",
    //                 'parent_id' => $p9->id,
    //                 'name_ar' => 'الاشعارات العامة',
    //                 'name' => 'public Notifications',
    //                 'guard_name' => $gaurd_name,
    //                 'page_url' => '',
    //                 'img' => '<i class="fas fa-circle text-danger"></i>',
    //                 'is_active' => 'Y',
    //             )
    //         );
    //             Permission::create(
    //                 array('type' => "action", 'parent_id' => $p99->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //             );
    //             Permission::create(
    //                 array('type' => "action", 'parent_id' => $p99->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //             );
    //         $p999=Permission::create(
    //             array(
    //                 'type' => "page",
    //                 'parent_id' => $p9->id,
    //                 'name_ar' => 'الاشعارات بمنتج',
    //                 'name' => 'Notifications for product',
    //                 'guard_name' => $gaurd_name,
    //                 'page_url' => '',
    //                 'img' => '<i class="fas fa-circle text-danger"></i>',
    //                 'is_active' => 'Y',
    //             )
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p999->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p999->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p10=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'الاعلانات',
    //             'name' => 'Advertisings',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => '',
    //             'img' => '<i class="fas fa-bullhorn text-danger"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         $p100=Permission::create(
    //             array(
    //                 'type' => "page",
    //                 'parent_id' => $p10->id,
    //                 'name_ar' => 'الاسبونسر',
    //                 'name' => 'Sponser',
    //                 'guard_name' => $gaurd_name,
    //                 'page_url' => 'advertisings/sponser/0',
    //                 'img' => '<i class="fas fa-circle text-danger"></i>',
    //                 'is_active' => 'Y',
    //             )
    //         );
    //             Permission::create(
    //                 array('type' => "action", 'parent_id' => $p100->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //             );
    //             Permission::create(
    //                 array('type' => "action", 'parent_id' => $p100->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //             );
    //         $p101=Permission::create(
    //             array(
    //                 'type' => "page",
    //                 'parent_id' => $p10->id,
    //                 'name_ar' => 'اعلان داخلي',
    //                 'name' => 'intern Adv',
    //                 'guard_name' => $gaurd_name,
    //                 'page_url' => 'advertisings/intern/0',
    //                 'img' => '<i class="fas fa-circle text-danger"></i>',
    //                 'is_active' => 'Y',
    //             )
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p101->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p101->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    $p10=Permission::create(
            array(
                'type' => "page",
                'parent_id' => 0,
                'name_ar' => 'روابط التواصل',
                'name' => 'Social media',
                'guard_name' => $gaurd_name,
                'page_url' => 'social-media',
                'img' => '<i class="icon-xl fas fa-share-alt-square text-warning"></i>',
                'is_active' => 'Y',
            )
        );
            Permission::create(
                array('type' => "action", 'parent_id' => $p10->id, 'name_ar' => 'إضافة', 'name' => 'Add', 'guard_name' => $gaurd_name,'is_active' => 'Y')
            );
            Permission::create(
                array('type' => "action", 'parent_id' => $p10->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
            );
            Permission::create(
                array('type' => "action", 'parent_id' => $p10->id, 'name_ar' => 'تفعيل', 'name' => 'Active', 'guard_name' => $gaurd_name,'is_active' => 'Y')
            );
            Permission::create(
                array('type' => "action", 'parent_id' => $p10->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
            );
    // $p11=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'البريد الوارد',
    //             'name' => 'Contact Messages',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'contact-messages',
    //             'img' => '<i class="icon-xl fas fa-mail-bulk text-success"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //        Permission::create(
    //             array('type' => "action", 'parent_id' => $p11->id, 'name_ar' => 'اطلاع', 'name' => 'View', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p11->id, 'name_ar' => 'رد', 'name' => 'Reply', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p11->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    // $p12=Permission::create(
    //         array(
    //             'type' => "page",
    //             'parent_id' => 0,
    //             'name_ar' => 'القائمه البريديه',
    //             'name' => 'Mail Subscribes',
    //             'guard_name' => $gaurd_name,
    //             'page_url' => 'social-media/',
    //             'img' => '<i class="icon-xl fas fa-share-alt-square text-warning"></i>',
    //             'is_active' => 'Y',
    //         )
    //     );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p12->id, 'name_ar' => 'اطلاع', 'name' => 'View', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p12->id, 'name_ar' => 'ارسال', 'name' => 'Send', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    //         Permission::create(
    //             array('type' => "action", 'parent_id' => $p12->id, 'name_ar' => 'حذف', 'name' => 'Delete', 'guard_name' => $gaurd_name,'is_active' => 'Y')
    //         );
    $p111=Permission::create(
            array(
                'type' => "page",
                'parent_id' => 0,
                'name_ar' => 'الاعدادات العامة',
                'name' => 'Main setting',
                'guard_name' => $gaurd_name,
                'page_url' => 'setting-page',
                'img' => '<i class="icon-xl fas fa-cogs text-info"></i>',
                'is_active' => 'Y',
            )
        );
            Permission::create(
                array('type' => "action", 'parent_id' => $p111->id, 'name_ar' => 'تعديل', 'name' => 'Edit', 'guard_name' => $gaurd_name,'is_active' => 'Y')
            );





    //     $permissions = [
    //         //pages
    //         ['Admin Users','المستخدمين',,'Y'],
    //         'Users'=>'المستخدمين',
    //         'Users'=>'قائمة المستخدمين',
    //         'Users'=>'صلاحيات المستخدمين',
    //         'Users'=>'الاعدادات',
    //         'Users'=>'المنتجات',
    //         'Categories'=>'الاقسام',
    //         'Categories'=>'الاقسام',
    //         'Users'=>'اضافة مستخدم',
    //         'Users'=>'تعديل مستخدم',
    //         'Users'=>'حذف مستخدم',

    //         'Users'=>'عرض صلاحية',
    //         'Users'=>'اضافة صلاحية',
    //         'Users'=>'تعديل صلاحية',
    //         'Users'=>'حذف صلاحية',

    //         'Users'=>'اضافة منتج',
    //         'Users'=>'تعديل منتج',
    //         'Users'=>'حذف منتج',

    //         'Users'=>'اضافة قسم',
    //         'Users'=>'تعديل قسم',
    //         'Users'=>'حذف قسم',
    //         'Users'=>'الاشعارات',
    //         'Users'=>'الفواتير',
    //         'Users'=>'قائمة الفواتير',
    //         'Users'=>'الفواتير المدفوعة',
    //         'الفواتير المدفوعة جزئيا',
    //         'الفواتير الغير مدفوعة',
    //         'ارشيف الفواتير',
    //         'التقارير',
    //         'تقرير الفواتير',
    //         'تقرير العملاء',



    //         'اضافة فاتورة',
    //         'حذف الفاتورة',
    //         'تصدير EXCEL',
    //         'تغير حالة الدفع',
    //         'تعديل الفاتورة',
    //         'ارشفة الفاتورة',
    //         'طباعةالفاتورة',
    //         'اضافة مرفق',
    //         'حذف المرفق',



    // ];



    // foreach ($permissions as $permission) {

    // Permission::create(['name_ar' => $permission]);
    // }

    }
}
