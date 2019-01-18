<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} Admin Panel</title>
        
        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <!-- Admin theme -->
        <link href="{{ mix('_admin/css/sb-admin.css') }}" rel="stylesheet">
    </head>

    <body id="page-top" class="{{$bodyClass ?? ''}}">
        
        <div id="app">
            @section('main-content')

                @include('layouts.admin.partials.topnav')

                <div id="wrapper">
                    @include('layouts.admin.partials.sidenav')

                    <div id="content-wrapper">
                        <div class="container-fluid">

                            <!-- Breadcrumbs-->
                            @yield('breadcrumbs')
                            
                            @yield('page-content')

                        </div>
                        <!-- /.container-fluid-->
                        
                        <!-- Sticky Footer -->
                        <footer class="sticky-footer">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span>Copyright © {{ config('app.author') }} {{ date('Y') }}</span>
                                </div>
                            </div>
                        </footer>
                    </div>
                    <!-- /.content-wrapper -->

                </div>
                <!-- /#wrapper -->

                <!-- Scroll to Top Button-->
                <back-to-top inline-template>
                    <a class="scroll-to-top rounded" 
                        v-scroll-to="'#page-top'"
                        v-bind:class="{'scroll-to-top--visible':backToTopVisible}" 
                        href="javascript:void(0)">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </back-to-top>
                
                <!-- Logout Modal-->
                <b-modal id="logout-modal" ref="logoutModal" title="Ready to Leave?">
                    Select "Logout" below if you are ready to end your current session.
                    <div slot="modal-footer">
                        <button class="btn btn-secondary" type="button" @click="$refs.logoutModal.hide()">Cancel</button>&nbsp;
                        <a class="btn btn-primary" href="{{ route('admin.logout') }}">Logout</a>
                    </div>
                </b-modal>
            @show
        </div>
        
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>

        <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
        
        <script type="text/javascript">
            Vue.component('back-to-top', {
                data() {
                    return {
                        backToTopVisible: false,
                    }
                },
                created: function created() {
                    window.addEventListener('scroll', this.handleScroll);
                },
                methods: {
                    getScrollTop: function getScrollTop() {
                        return window.pageYOffset !== undefined ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
                    },
        
                    handleScroll: function handleScroll() {
                        if (this.getScrollTop() > 100) {
                            this.backToTopVisible = true;
                        } else {
                            this.backToTopVisible = false;
                        }
                    }
                }
            });
        </script>
        
        @stack('footer-scripts')
    </body>
</html>