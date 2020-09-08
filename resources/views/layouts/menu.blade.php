@php

  use Illuminate\Database\Eloquent\Builder;
  use \App\Menu;
  use \App\Submenu;
  
  $menus = Menu::whereHas('accesses', function(Builder $query) {
    $query->where('role_id', Auth::user()->role_id);
  })->with(['submenus' => function($query) {
    $query->where('active', 1);
  }])->has('submenus')->get();

@endphp


@foreach ($menus as $menu)

  <li class="nav-header">{{ strtoupper($menu->menu) }}</li>

  @foreach ($menu->submenus as $submenu)
    <li class="nav-item">
      <a href="{{ route($submenu->route) }}" class="nav-link {{ $submenu->identifier }}">
        <i class="nav-icon {{ $submenu->icon }}"></i>
        <p>
          {{ $submenu->submenu }}
        </p>
      </a>
    </li>
  @endforeach

@endforeach

<div class="mb-5"></div>