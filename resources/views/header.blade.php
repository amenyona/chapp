<div class="d-flex">
    <!-- LOGO -->
    <div class="navbar-brand-box" style="background: #7928CA;">
        <a href="{{route('auth.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('assets/images/logomissa.jpg')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('assets/images/logomissa.jpg')}}" alt="" height="17">
            </span>
        </a>

        <a href="{{route('auth.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('assets/images/logomissa.jpg')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('assets/images/logomissa.jpg')}}" alt="" height="100">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <!-- App Search-->
 

   
</div>

<div class="d-flex">

    <div class="dropdown d-inline-block d-lg-none ms-2">
        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-magnify"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
            aria-labelledby="page-header-search-dropdown">

            <form class="p-3">
                <div class="form-group m-0">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    
    <div class="dropdown d-none d-lg-inline-block ms-1">
        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
            <i class="bx bx-fullscreen"></i>
        </button>
    </div>

 

    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if ($loggedUserInfo->image!="")
        <img src="{{url('upload/',$loggedUserInfo->image)}}" alt="" class="rounded-circle" style="height: 30px;width: 30px;">
        @else
             <img class="rounded-circle header-profile-user" src="{{asset('assets/images/users/avatar-1.jpg')}}"
                alt="Header Avatar">
        @endif
            <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ $loggedUserInfo->name }} {{$loggedUserInfo->firstname}}</span>
            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <a class="dropdown-item" href="{{route('auth.profile',$loggedUserInfo->uuid)}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
            <div class="dropdown-divider"></div>
            <!-- <a class="dropdown-item text-danger" href="{{ route('auth.logout') }}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a> -->
            <form method="POST" action="{{ route('logout') }}" class="dropdown-item dropdown-footer">
                            @csrf
                            <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Se Déconnecter') }}
                            </x-dropdown-link>
            </form>
    </div>

    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
            <i class="bx bx-cog bx-spin"></i>
        </button>
    </div>

</div>