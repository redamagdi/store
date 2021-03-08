<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"> Menu Management </li>
        <!-- Optionally, you can add icons to the links -->
        @if( is_permited('dashboard','view') == 1 )
        <li class="{{ is_active('dashboard') }}" ><a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i> <span>Dashboard ( لوجة التحكم ) </span></a></li>
        @endif

        @if( is_permited('casher','view') == 1 )
          <li class="{{ is_active('casher') }}" ><a href="{{ route('dashboard.casher') }}"><i class="fa fa-laptop"></i> <span>Casher ( لوحة الكاشير) </span></a></li>
        @endif

        @if( (is_permited('groups','view') == 1) || ( is_permited('users','view') == 1 )  )
        <li class="treeview {{ is_active('groups') }} {{ is_active('users') }}">
          <a href="#"><i class="fa fa-users"></i> <span> U/M ( ادارة المستخدمين ) </span>
          </a>
          <ul class="treeview-menu">
            @if( is_permited('groups','view') == 1 )
            <li class="{{ is_active('groups') }}" ><a href="{{ route('groups.index') }}"> <i class='fa fa-users'></i> Groups ( المجموعات ) </a></li>
            @endif

            @if( is_permited('users','view') == 1 )
            <li class="{{ is_active('users') }}" ><a href="{{ route('users.index') }}"> <i class='fa fa-user'></i> Users ( المستخدمين ) </a></li>
            @endif
          </ul>
        </li>
        @endif

        @if( (is_permited('suppliers','view') == 1) )
        <li class="treeview {{ is_active('suppliers') }}">
          <a href="#"><i class="fa fa-users"></i> <span> S/C/M ( ادارة العملاء و الموردين ) </span>
          </a>
          <ul class="treeview-menu">
            @if( is_permited('suppliers','view') == 1 )
            <li class="{{ is_active('suppliers') }}" ><a href="{{ route('suppliers.index') }}"> <i class='fa fa-user'></i>S/C ( العملاء والموردين )</a></li>
            @endif
          </ul>
        </li>
        @endif

        @if( (is_permited('outcomes','view') == 1) || (is_permited('categories','view') == 1) || (is_permited('products','view') == 1) || ( (is_permited('units','view') == 1) ) )

        <li class="treeview {{ is_active('outcomes') }} {{ is_active('categories') }} {{ is_active('products') }} {{ is_active('units') }} ">
          <a href="#"><i class="fa fa-cubes"></i> <span> Store ( المخزن ) </span>
          </a>
          <ul class="treeview-menu">
            @if( is_permited('categories','view') == 1 )
            <li class="{{ is_active('categories') }}" ><a href="{{ route('categories.index') }}"><i class='fa fa-archive'></i> Category ( الاقسام )</a></li>
            @endif

            @if( is_permited('units','view') == 1 )
            <li class="{{ is_active('units') }}" ><a href="{{ route('units.index') }}"><i class='fa  fa-asterisk'></i> Units ( الوحدات )</a></li>
            @endif

            @if( is_permited('products','view') == 1 )
            <li class="{{ is_active('products') }}" ><a href="{{ route('products.index') }}"><i class='fa fa-archive'></i> Products ( الاصناف )</a></li>
            @endif

            @if( is_permited('outcomes','view') == 1 )
              <li class="{{ is_active('outcomes') }}" ><a href="{{ route('outcomes.index') }}"><i class='fa fa-reply-all'></i> Out Comes ( المصروفات )</a></li>
            @endif
          </ul>
        </li>
       @endif

       @if( (is_permited('PurchaseInvoice','view') == 1) || (is_permited('sellInvoice','view') == 1) || ( (is_permited('totalgainindex','view') == 1) ) )
        <li class="treeview {{ is_active('PurchaseInvoice') }} {{ is_active('sellInvoice') }} {{ is_active('totalgainindex') }}">
          <a href="#"><i class="fa fa-book"></i> <span> INVO/M ( ادارة الفواتير ) </span>
          </a>
          <ul class="treeview-menu">
            @if( is_permited('PurchaseInvoice','view') == 1 )
            <li class="{{ is_active('PurchaseInvoice') }}" ><a href="{{ route('purchaseInvoice.index') }}"><i class="fa fa-cloud-download"></i> PUR/IN ( فواتير المشتريات ) </a></li>
            @endif

            @if( is_permited('sellInvoice','view') == 1 )
            <li class="{{ is_active('sellInvoice') }}" ><a href="{{ route('sellInvoice.index') }}"><i class="fa fa-cloud-upload"></i> SELL/IN ( فواتير المبيعات ) </a></li>
            @endif

            @if( is_permited('totalgainindex','view') == 1 )
            <li class="{{ is_active('totalgainindex') }}" ><a href="{{ route('totalgainindex.index') }}"><i class="fa fa-money"></i> TG/IN/P ( صافي الربح لفنرة ) </a></li>
            @endif

          </ul>
        </li>

        @endif

        @if( is_permited('boxes','view') == 1 )
        <li class="{{ is_active('boxes') }}" ><a href="{{ route('boxes.index') }}"><i class="fa fa-money"></i> <span>Box ( الصندوق ) </span></a></li>
        @endif

        @if( is_permited('otherinvoices','view') == 1 )
        <li class="{{ is_active('otherinvoices') }}" ><a href="{{ route('otherinvoices.index') }}"><i class="fa fa-cloud-upload"></i> <span>Other Invoice ( المصروفات ) </span></a></li>
        @endif
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
