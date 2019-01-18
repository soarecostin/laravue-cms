<ul class="navbar-nav ml-auto">
    @if (isset($menuItems))
    @foreach ($menuItems as $menuItem)
        @if ($menuItem->isRoot())
        <li class="nav-item {{ $menuItem->activeChildren()->count() ? 'dropdown' : '' }}">
            <a class="nav-link {{ $menuItem->activeChildren()->count() ? 'dropdown-toggle' : '' }}" 
                @if ($menuItem->activeChildren()->count())
                id="navbarDropdown{{ $menuItem->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                @endif
                href="{{ $menuItem['url'] }}" role="button">
                {{ $menuItem['title'] }}
            </a>
            @if ($menuItem->activeChildren()->count())
            <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $menuItem->id }}">
                @foreach ($menuItems as $menuChild)
                    @if ($menuChild->isChildOf($menuItem))
                        <a class="dropdown-item" href="{{ $menuChild['url'] }}">{{ $menuChild['title'] }}</a>
                    @endif
                @endforeach
            </div>
            @endif
        </li>
        @endif
    @endforeach
    @endif
</ul>
<ul class="navbar-nav navbar-btns">
    @guest('web')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Log In</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link--inverse" href="{{ route('register') }}">Sign Up</a>
    </li>
    @else
    <li class="nav-item dropdown">
        <a id="navbar-dropdown-account" href="/user" class="nav-link nav-link--inverse dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
            <i class="fas fa-user-alt"></i>&nbsp;
            My Account
        </a>
        <div aria-labelledby="navbar-dropdown-account" class="dropdown-menu">
            <a href="/user" class="dropdown-item">Dashboard</a>
            <a href="/user/logout" class="dropdown-item">Logout</a>
        </div>
    </li>
    @endguest
</ul>