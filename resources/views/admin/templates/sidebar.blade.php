<?php
    $navCategories = mcriver\Category::orderBy('display_order')->get();
?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{(isset($active_page)) && ($active_page == 'sign-ups')?'active':''}}"><a href="{{url('/')}}/admin/sign-ups"><span>Sign Ups</span></a></li>
            <li class="{{(isset($active_page)) && ($active_page == 'equipment')?'active':''}}"><a href="{{url('/')}}/admin/equipment"><span>Equipment Totals</span></a></li>
            <li class="treeview {{(isset($active_page)) && ($active_page == 'products')?'active':''}}">
                <a href="#"><span>Products</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                @foreach($navCategories as $category)
                    <li><a href="{{url('/')}}/admin/products/{{$category->id}}">{{$category->name}}</a></li>
                @endforeach
                    <li><a href="{{url('/')}}/admin/products">Edit Product Categories</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>