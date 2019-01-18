<!-- Sidebar -->
<b-nav vertical class="sidebar navbar-nav" :class="{'toggled':sidebarToggled}">
    @foreach ($nav as $navKey => $navData)

        @php $activeChildren = false; @endphp
        @if (isset($navData['children']))
            @foreach ($navData['children'] as $navChildKey => $navChildData)
                @if (isset($settings['navPath']) && $settings['navPath'] == $navChildKey)
                    @php $activeChildren = true; @endphp
                @endif
            @endforeach
        @endif
    
        @if (!isset($navData['children']))
        <b-nav-item 
            class="{{ ((isset($settings['navPath']) && $settings['navPath'] == $navKey) || $activeChildren) ? 'active show' : '' }}"
            title="{{ $navData['name'] }}"
            href="{{ $navData['link'] }}">
            <i class="fa-fw {{ $navData['icon'] }}"></i>
            <span class="nav-link-text">{{ $navData['name'] }}</span>
        </b-nav-item>
        @else
        <b-nav-item-dropdown class="{{ (!$activeChildren ?: 'active show' ) }}" extra-menu-classes="{{ (!$activeChildren ?: 'show' ) }}">
            <template slot="button-content">
                <i class="fa-fw {{ $navData['icon'] }}"></i>
                <span class="nav-link-text">{{ $navData['name'] }}</span>
            </template>
            @foreach ($navData['children'] as $navChildKey => $navChildData)
            <b-dropdown-item
                href="{{ $navChildData['link'] }}"
                {{ isset($settings['navPath']) && $settings['navPath'] == $navChildKey ? 'active' : '' }}
            >
                <i class="fa-fw {{ $navChildData['icon'] }}"></i>
                {{ $navChildData['name'] }}
            </b-dropdown-item>
            @endforeach
        </b-nav-item-dropdown>
        @endif

    @endforeach
</b-nav>