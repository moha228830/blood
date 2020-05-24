  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" >

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">



      <!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
       -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">

        <!-- Optionally, you can add icons to the links -->
        <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("home")}}"><i class="fa fa-home"></i> <span> الرئيسية</span></a></li>


      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("governs.index")}}"><i class="fa fa-map-marker"></i> <span>المحافظات </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("cities.index")}}"><i class="fa fa-flag"></i> <span>المدن </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("categories.index")}}"><i class="fa fa-list"></i> <span>الموضوعات </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("posts.index")}}"><i class="fa fa-comment"></i> <span>المقالات </span></a></li>

      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("clients.index")}}"><i class="fa fa-users"></i> <span>@lang('site.clients') </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("contacts.index")}}"><i class="fa fa-phone"></i> <span>@lang('site.contacts') </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("bloodTypes.index")}}"><i class="fa fa-link"></i> <span>@lang('site.bloodTypes') </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("settings.index")}}"><i class="fa fa-cogs"></i> <span>@lang('site.settings') </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("donationReqs.index")}}"><i class="fa fa-cogs"></i> <span>@lang('site.donationReqs') </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("profile.index")}}"><i class="fa fa-cogs"></i> <span>@lang('site.profile') </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("users.index")}}"><i class="fa fa-cogs"></i> <span>@lang('المشرفين') </span></a></li>
      <li  class="moha" ><a style="color:rgb(255, 255, 255)" href="{{route("roles.index")}}"><i class="fa fa-cogs"></i> <span>@lang('رتب المشرفين') </span></a></li>




          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
