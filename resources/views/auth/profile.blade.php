<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>La Sainte Messe-{{$tableau['liste']}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/logomissa.jpg')}}">

    <!-- dragula css -->
    <link href="asset('assets/libs/dragula/dragula.min.css')" rel="stylesheet" type="text/css" />
    <!-- select2 css -->
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
        /* for desktop */
        .whatsapp_float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .whatsapp-icon {
            margin-top: 16px;
        }

        /* for mobile */
        @media screen and (max-width: 767px) {
            .whatsapp-icon {
                margin-top: 10px;
            }

            .whatsapp_float {
                width: 40px;
                height: 40px;
                bottom: 20px;
                right: 10px;
                font-size: 22px;
            }

        }
    </style>
</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar" style="background: #FF0080;">
            <div class="navbar-header">
                @include('header')
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu" style="background: #7928CA;">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->

                @include('sidebar')

                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">{{$tableau['liste']}}</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{$tableau['liste']}}</a></li>
                                        <li class="breadcrumb-item active">{{$tableau['table']}}</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-4">

                        </div>
                        <!-- end col -->

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('auth.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="{{route('auth.dashboard')}}" class="btn btn-primary waves-effect waves-light btn-sm">Aller &agrave; l'accueil <i class="mdi mdi-arrow-left ms-1"></i></a>
                                            </div>
                                            <div class="col-sm-6">
                                                @if ($loggedUserInfo->image!="")
                                                <img src="{{url('upload/',$loggedUserInfo->image)}}" alt="image profile" class="rounded-circle" style="height: 70px;width: 70px;">
                                                @else
                                                <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="image profile">
                                                @endif
                                            </div>

                                        </div>


                                        <div id="task-2">
                                            <div id="inprogress-task" class="pb-1 task-list">
                                                <div class="card task-box" id="intask-1">
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <label for="lastname">Nom</label>
                                                            <input type="text" class="form-control" name="lastname" value="{{strtoupper($userInfo[0]->name)}}" required>
                                                            <span class="text-danger">@error('lastname'){{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="firstname">Prénom</label>
                                                            <input type="text" class="form-control" name="firstname" value="{{$userInfo[0]->firstname}}" required>
                                                            <span class="text-danger">@error('firstname'){{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" name="email" value="{{$userInfo[0]->email}}" required>
                                                            <span class="text-danger">@error('email'){{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone">Phone</label>
                                                            <input id="phone" name="phone" type="text" class="form-control" value="{{$user->phone}}" required>
                                                            <span class="text-danger">@error('phone'){{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="control-label">Sexe</label>
                                                            <select class="form-control select2" name="sexe">
                                                                <option>Veuillez Selectionner</option>
                                                                <option value="feminin" <?= $user->sexe == 'feminin' ? ' selected="selected"' : ''; ?>>Feminin</option>
                                                                <option value="masculin" <?= $user->sexe == 'masculin' ? ' selected="selected"' : ''; ?>>Masculin</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- end task card -->

                                                <div class="card task-box" id="intask-2">
                                                    <div class="card-body">
                                                        <input type="hidden" name="iduser" value="{{$user->id}}">
                                                        <div class="mb-3">
                                                            <label for="cure">Curé</label>
                                                            <label for="cure"> <strong>{{$userInfor->name}} {{$userInfor->firstname}}</strong></label>
                                                            <span class="text-danger">@error('cure'){{ $message }}
                                                                @enderror
                                                            </span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="control-label">Roles</label>
                                                            <select class="form-control select2" name="role" required>
                                                                <option value="{{$roles['id']}}" {{ ( $roles['id'] == $roleid) ? 'selected' : '' }}>{{$roles['name']}}</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="control-label">Eglises</label>
                                                            <select class="form-control select2" name="eglise" required>
                                                                <option value="{{$eglises['id']}}" {{ ( $eglises['id'] == $egliseid) ? 'selected' : '' }}>{{$eglises['nom']}}</option>
                                                            </select>
                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- end task card -->

                                                <div class="card task-box" id="intask-3">
                                                    <div class="card-body">
                                                        <input type="hidden" name="editprofile" value="editprofile">
                                                        <div class="mb-3">
                                                            <label for="example-date-input" class="control-label">Date de naissance</label>
                                                            <input class="form-control" type="date" value="{{$user->birthdate}}" name="date_input" id="example-date-input">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="phone">Image Profile</label>
                                                            <input class="form-control" type="file" id="formFile" name="image">
                                                            <span class="text-danger">@error('image'){{ $message }}
                                                                @enderror
                                                            </span>
                                                            <input type="hidden" name="my_image" value="{{$user->image}}">
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="card task-box" id="intask-3">
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <label for="password">Password</label>
                                                            <input type="password" class="form-control" id="horizontal-password-input" placeholder="Entrer le mot de passe" name="password" required>
                                                            <span class="text-danger">@error('password'){{ $message }}

                                                                @enderror</span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="password">Confirm Password</label>
                                                            <input type="password" class="form-control" name="new_confirm_password" placeholder="Confirmer le mot de passe" required>
                                                            <span class="text-danger">@error('new_confirm_password'){{ $message }}

                                                                @enderror</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- end task card -->

                                            </div>

                                            <div class="text-center d-grid">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-lg-4">

                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                @include('footer')
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="{{asset('assets/images/layouts/layout-1.jpg')}}" class="img-fluid img-thumbnail" alt="">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="{{asset('assets/images/layouts/layout-2.jpg')}}" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="{{asset('assets/images/layouts/layout-3.jpg')}}" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="form-check form-switch mb-5">
                    <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css">
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>


            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- dragula plugins -->
    <script src="{{asset('assets/libs/dragula/dragula.min.js')}}"></script>
    <!-- select 2 plugin -->
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <!-- init js -->
    <script src="{{asset('assets/js/pages/ecommerce-select2.init.js')}}"></script>

    <!-- jquery-validation -->
    <script src="{{asset('assets/libs/jquery-validation/jquery.validate.min.js')}}"></script>

    <script src="{{asset('assets/js/pages/task-kanban.init.js')}}"></script>

    <script src="{{asset('assets/js/pages/task-form.init.js')}}"></script>

    <script src="{{asset('assets/js/app.js')}}"></script>

</body>

</html>