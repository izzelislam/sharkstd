@php
  $main = [
    'product'   => [
      'title'    => 'Product',
      'name'     => 'back-office/products',
      'icon'     => 'box',
      'role'     => ['admin', 'instructor'],
      'children' => [
        [
          'title' => 'Produk',
          'url' => '/back-office/products',
        ],
        [
          'title' => 'Trashed',
          'url' => '/back-office/products-trashed',
        ],
      ]
    ],
    'order' =>  [
      'title'  => 'Order',
      'url'    => '/back-office/orders',
      'name'   => 'back-office/orders',
      'icon'   => 'shopping-bag',
      'role'   => ['admin']
    ],
    'payout' =>  [
      'title'  => 'Payouts',
      'url'    => '/back-office/payouts',
      'name'   => 'back-office/payouts',
      'icon'   => 'credit-card',
      'role'   => ['admin']
    ],
    'wallet' =>  [
      'title'  => 'Wallet',
      'url'    => '/back-office/wallets',
      'name'   => 'back-office/wallets',
      'icon'   => 'book',
      'role'   => ['admin']
    ],
    'blog' =>  [
      'title'  => 'Blog',
      'url'    => '/back-office/blogs',
      'name'   => 'back-office/blogs',
      'icon'   => 'file-text',
      'role'   => ['admin']
    ],
  ];

  $master = [
    'category' =>  [
      'title'  => 'Product Category',
      'url'    => '/back-office/product-categories',
      'name'   => 'back-office/product-categories',
      'icon'   => 'tag',
      'role'   => ['admin']
    ],
    'blog_category' =>  [
      'title'  => 'Blog Category',
      'url'    => '/back-office/blog-categories',
      'name'   => 'back-office/blog-categories',
      'icon'   => 'cloud',
      'role'   => ['admin']
    ],
    'compatible' =>  [
      'title'  => 'Compatible',
      'url'    => '/back-office/compatibles',
      'name'   => 'back-office/compatibles',
      'icon'   => 'package',
      'role'   => ['admin']
    ],
    'feature' =>  [
      'title'  => 'Feature',
      'url'    => '/back-office/features',
      'name'   => 'back-office/features',
      'icon'   => 'cpu',
      'role'   => ['admin']
    ],
    'license' =>  [
      'title'  => 'License',
      'url'    => '/back-office/licenses',
      'name'   => 'back-office/licenses',
      'icon'   => 'file',
      'role'   => ['admin']
    ],
    'tool' =>  [
      'title'  => 'Tool',
      'url'    => '/back-office/tools',
      'name'   => 'back-office/tools',
      'icon'   => 'tool',
      'role'   => ['admin']
    ],
  ];

  $config = [
    'customer' =>  [
      'title'  => 'Customer',
      'url'    => '/back-office/customers',
      'name'   => 'back-office/customers',
      'icon'   => 'user',
      'role'   => ['admin']
    ],
    'seller' =>  [
      'title'  => 'Seller',
      'url'    => '/back-office/sellers',
      'name'   => 'back-office/sellers',
      'icon'   => 'pocket',
      'role'   => ['admin']
    ],
    'admin' =>  [
      'title'  => 'Admin',
      'url'    => '/back-office/admins',
      'name'   => 'back-office/admins',
      'icon'   => 'square',
      'role'   => ['admin']
    ],
    'setting' =>  [
      'title'  => 'Setting',
      'url'    => '/back-office/settings',
      'name'   => 'back-office/settings',
      'icon'   => 'settings',
      'role'   => ['admin']
    ],
  ];
@endphp

<div class="page-sidebar">
  <ul class="list-unstyled accordion-menu">
    <li class="sidebar-title">
      Main
    </li>

    <li class="{{ request()->is('back-office/dashboard') ? 'active-page' : '' }}">
      <a href="/back-office/dashboard"><i data-feather="home"></i>Dashboard</a>
    </li>

    @foreach ($main as $main_menu)
      @if(empty($main_menu["children"]))
        <li class="{{ request()->is($main_menu['name'].'*') ? 'active-page' : '' }}">
          <a href="{{ $main_menu["url"] }}"><i data-feather="{{ $main_menu["icon"] }}"></i>{{ $main_menu["title"] }}</a>
        </li>
      @else
        <li class="{{ request()->is($main_menu['name'].'*') ? 'active-page' : '' }}">
          <a href="" class="{{ request()->is($main_menu['name'].'*') ? 'active' : '' }}"><i data-feather="{{ $main_menu["icon"] }}"></i>{{ $main_menu["title"] }}<i class="fas fa-chevron-right dropdown-icon"></i></a>
          <ul class="" style="">
            @foreach ($main_menu["children"] as $main_child)
              <li><a href="{{ $main_child["url"] }}"><i class="far fa-circle"></i>{{ $main_child["title"] }}</a></li>
            @endforeach
          </ul>
        </li>
      @endif
    @endforeach

    @if (auth()->guard("admin")->user()->role === "administrator")
      <li class="sidebar-title">
        Master
      </li>
      @foreach ($master as $master_menu)
        @if(empty($master_menu["children"]))
          <li class="{{ request()->is($master_menu['name'].'*') ? 'active-page' : '' }}">
            <a href="{{ $master_menu["url"] }}"><i data-feather="{{ $master_menu["icon"] }}"></i>{{ $master_menu["title"] }}</a>
          </li>
        @else
          <li>
            <a href=""><i data-feather="{{ $master_menu["icon"] }}"></i>{{ $master_menu["title"] }}<i class="fas fa-chevron-right dropdown-icon"></i></a>
            <ul class="{{ request()->is($master_menu['name'].'*') ? 'active-page' : '' }}">
              @foreach ($master_menu["children"] as $master_child)
                <li><a href="{{ $master_child["url"] }}"><i class="far fa-circle"></i>{{ $master_child["title"] }}</a></li>
              @endforeach
            </ul>
          </li>
        @endif
      @endforeach

      <li class="sidebar-title">
        Config
      </li>
      @foreach ($config as $config_menu)
        @if(empty($config_menu["children"]))
          <li class="{{ request()->is($config_menu['name'].'*') ? 'active-page' : '' }}">
            <a href="{{ $config_menu["url"] }}"><i data-feather="{{ $config_menu["icon"] }}"></i>{{ $config_menu["title"] }}</a>
          </li>
        @else
          <li>
            <a href=""><i data-feather="{{ $config_menu["icon"] }}"></i>{{ $config_menu["title"] }}<i class="fas fa-chevron-right dropdown-icon"></i></a>
            <ul class="{{ request()->is($config_menu['name'].'*') ? 'active-page' : '' }}">
              @foreach ($config_menu["children"] as $child_config)
                <li><a href="{{ $child_config["url"] }}"><i class="far fa-circle"></i>{{ $child_config["title"] }}</a></li>
              @endforeach
            </ul>
          </li>
        @endif
      @endforeach
    @endif

  </ul>
</div>