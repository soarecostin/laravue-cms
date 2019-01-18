<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            @section ('header-brand')
            <h1>{{ config('app.name') }}</h1>
            @show
        </a>
        
        <navbar-toggle inline-template>
            <b-navbar-toggle target="navbar-responsive" v-bind:class="{ collapsed: !showMobileMenu }">
                <span class="navbar-toggler-icon" v-on:click="showMobileMenu = !showMobileMenu">
                    <svg width="30px" height="30px" viewBox="329 23 22 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(329.000000, 23.500000)">
                            <rect id="bar-3" fill="#000000" x="0" y="0" width="22" height="3" rx="2"></rect>
                            <rect id="bar-2" fill="#000000" x="0" y="7" width="22" height="3" rx="2"></rect>
                            <rect id="bar-1" fill="#000000" x="0" y="14" width="22" height="3" rx="2"></rect>
                        </g>
                    </svg>
                </span>
            </b-navbar-toggle>
        </navbar-toggle>
        
        <b-collapse is-nav id="navbar-responsive">
            @section ('header-navbar')
                @include ("layouts.main.partials.topnav")
            @show
        </b-collapse>
    </div>
</nav>

@push('footer-scripts')
<script type="text/javascript">
    Vue.component('navbar-toggle', {
        data() {
            return {
                showMobileMenu: false
            }
        }
    });
</script>
@endpush