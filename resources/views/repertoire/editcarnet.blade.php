<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>La Sainte Messe</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/logomissa.jpg')}}">
        <!-- select2 css -->
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- datepicker css -->
        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

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
                                    <h4 class="mb-sm-0 font-size-18">Créer Carnet De Baptême</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Carnets De Baptême</a></li>
                                            <li class="breadcrumb-item active">Créer Carnet De Baptême</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                    @if (renvoiRoleUser(session('LoggedUser')))
                                        <div class="mt-4">
                                            <a href="{{route('repertoire.listeFiles')}}" class="btn btn-primary waves-effect waves-light btn-sm">Aller à la liste<i class="mdi mdi-arrow-left ms-1"></i></a>
                                        </div>
                                    @endif
                                        <form action="{{ route('repertoire.updateCarnet',$carnet->uuid) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="results">
                                                @if (Session::get('success'))
                                                    <div class="alert alert-success">
                                                     {{Session::get('success')}}
                                                    </div>
                                                @endif
                           
                                                @if (Session::get('error'))
                                                    <div class="alert alert-danger">
                                                       {{Session::get('error')}}
                                                    </div>
                                                @endif
                        
                                                @if (Session::get('errorchamps'))
                                                <div class="alert alert-danger">
                                                    {{Session::get('errorchamps')}}
                                                 </div>
                                                @endif
                                            </div>
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <div class="form-group row mb-4">
                                                        <label for="titre" class="col-form-label col-lg-2">Carnet de Baptême</label>
                                                        <div class="col-lg-10">
                                                            <embed src="{{url('upload/',$carnet->imageCarnet)}}" width="100px" height="100px">
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="form-group row mb-4">
                                                        <label for="titre" class="col-form-label col-lg-2">Utilisateur</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-control select2" name="utilisateurs" required>
                                                                <option value="{{$egliseUsers->id}}">{{$egliseUsers->firstname.'-'.$egliseUsers->email}}</option>    
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label class="col-form-label col-lg-2">Description</label>
                                                        <div class="col-lg-10">
                                                            <textarea id="taskdesc-editor" name="contenu" required><?php echo $carnet->description;  ?></textarea>
                                                        </div>
                                                        <span class="text-danger">@error('contenu'){{ $message }}
                                                            @enderror
                                                         </span>
                                                         <input type="hidden" value="{{$repertoire->id}}" name="idrep">
                                                         <input type="hidden" value="{{$carnet->id}}" name="idcarnet">
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label class="col-form-label col-lg-2">Carnet De Baptême</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" type="file" id="formFile" name="image">
                                                            <span class="text-danger">@error('image'){{ $message }}
                                                                @enderror
                                                             </span>
                                                             <input type="hidden" name="my_image" value="{{$carnet->imageCarnet}}">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </div>
                                       
                                        </form>
                                        

                                    </div>
                                </div>
                            </div>
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
       
        <!-- bootstrap datepicker -->
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

        <!--tinymce js-->
        <script src="{{asset('assets/libs/tinymce/tinymce.min.js')}}"></script>
        <!-- select 2 plugin -->
        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <!-- form repeater js -->
        <script src="{{asset('assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
        <script src="{{asset('assets/js/pages/ecommerce-select2.init.js')}}"></script>

        <script src="{{asset('assets/js/pages/task-create.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>
        

    </body>
</html>
