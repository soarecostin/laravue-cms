<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="/">{{ config('app.name') }}</a>
    
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" @click="sidebarToggled = !sidebarToggled" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <?php /*
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        */ ?>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle">
                <i class="fas fa-bell fa-fw"></i>
                <!--
                <span class="badge badge-danger">9+</span>
                -->
            </a>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle">
                <i class="fas fa-envelope fa-fw"></i>
                <!--
                <span class="badge badge-danger">7</span>
                -->
            </a>
        </li>
        <li class="nav-item dropdown no-arrow">
            <b-dropdown toggle-class="nav-link border-0" :right="true" no-caret variant="link">
                <template slot="button-content">
                    <i class="fas fa-user-circle fa-fw"></i>
                </template>
                <b-dropdown-item>Settings</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item v-b-modal.logout-modal>Logout</b-dropdown-item>
            </b-dropdown>
        </li>
    </ul>
</nav>