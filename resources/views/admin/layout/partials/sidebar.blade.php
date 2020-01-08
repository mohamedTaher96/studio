<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-right image">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <img src='{{asset("images/admin/$admin->photo")}}' class="img-circle sidebar_img" alt="User Image"> 
        </div>
        <div class="pull-center info">
        <br><p> {{$admin->first_name}} {{$admin->last_name}}<i class="fa fa-circle text-success"></i></p>
        </div>
      </div>
      <!-- search form -->
      <form action="" method="get" class="sidebar-form">
        <div class="input-group">
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li><a href="https://studio-20.herokuapp.com/admin"><i class="fa fa-circle-o"></i> الصفحة الرئيسيه  </a></li>
        @if (Session::has('الرسائل'))
          <li><a href="https://studio-20.herokuapp.com/admin/messages/"><i class="fa fa-circle-o"></i>  الرسائل  </a></li>
        @endif
        @if (Session::has('المشتركون'))
          <li><a href="https://studio-20.herokuapp.com/admin/other/subscribers/"><i class="fa fa-circle-o"></i>  المشتركون  </a></li>
        @endif
        @if (Session::has('الصور والتصنيفات'))
          <li><a href="https://studio-20.herokuapp.com/admin/gallery/"><i class="fa fa-circle-o"></i>  معرض الصور  </a></li>
        @endif
        @if (Session::has('الرزم والخيارات'))
          <li><a href="https://studio-20.herokuapp.com/admin/orders/packages/"><i class="fa fa-circle-o"></i>  الأوردر  </a></li>
        @endif
        @if (Session::has('الصفحات'))
        <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>الصفحات</span>
              <i class="fa fa-angle-left pull-left"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="https://studio-20.herokuapp.com/admin/editPages/content/"><i class="fa fa-circle-o"></i>  محتوي الصفحات </a></li>
              <li><a href="https://studio-20.herokuapp.com/admin/editPages/translation/"><i class="fa fa-circle-o"></i>  الترجمة </a></li>
              <li><a href="https://studio-20.herokuapp.com/admin/editPages/others/"><i class="fa fa-circle-o"></i>  الغلاف واللينكات </a></li>
            </ul>
          </li> 
        @endif
        @if (Session::has('المشرفون') |Session::has('العملاء')|Session::has('المشتركون'))
          <li class="treeview">
            <a href="https://studio-20.herokuapp.com/admin/other/">
              <i class="fa fa-share"></i> <span>أخري</span>
              <i class="fa fa-angle-left pull-left"></i>
            </a>
            <ul class="treeview-menu">
              @if (Session::has('المشرفون'))
                <li><a href="https://studio-20.herokuapp.com/admin/other/admins/"><i class="fa fa-circle-o"></i>  المشرفون </a></li>
              @endif
              @if (Session::has('المشتركون'))
                <li><a href="https://studio-20.herokuapp.com/admin/other/subscribers/"><i class="fa fa-circle-o"></i>  المشتركون </a></li>
              @endif
              @if (Session::has('العملاء'))
                <li><a href="https://studio-20.herokuapp.com/admin/other/clients/"><i class="fa fa-circle-o"></i>  العملاء </a></li>
              @endif
              
              
              
            </ul>
          </li>
        @endif
        
        
        


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>