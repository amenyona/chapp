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

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <style>
            .textForm{
                font-size: 1.8em;
            }
            #indeximg{
                   height: 70px;
                   width: 70px;
               }
               .editimg{
                   height: 70px;
                   width: 100px;
               } 
               
               #wazimg{
                   height: 70px;
                   width: 70;
               }        
               .idshowimg{
                   height: 220px;
                   width: 220px;
               }
                    /* for desktop */
            .whatsapp_float {
                position:fixed;
                width:60px;
                height:60px;
                bottom:40px;
                right:40px;
                background-color:#25d366;
                color:#FFF;
                border-radius:50px;
                text-align:center;
                    font-size:30px;
                box-shadow: 2px 2px 3px #999;
                    z-index:100;
            }

            .whatsapp-icon {
                margin-top:16px;
            }
            /* for mobile */
            @media screen and (max-width: 767px){
                .whatsapp-icon {
                margin-top:10px;
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
                                    <h4 class="mb-sm-0 font-size-18">{{$repertoire->nom}}</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item">Documents</li>
                                            <li class="breadcrumb-item active">{{$repertoire->nom}}</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    
                                    <div class="mt-4 mb-sm-0 font-size-18">
                                        <a href="{{route('repertoire.createdoc',$repertoire->uuid)}}" class="btn btn-primary waves-effect waves-light btn-sm">Créer document <i class="mdi mdi-arrow-right ms-1"></i></a>
                                      </div>

                                    <div class="page-title-right">
                                        <div class="mt-4">
                                            <a href="{{route('repertoire.index')}}" class="btn btn-primary waves-effect waves-light btn-sm">Aller à la liste <i class="mdi mdi-arrow-left ms-1"></i></a>
                                          </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                       
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                            
                        @endif
                        @if (session()->has('succesdanger'))
                        <div class="alert alert-danger">
                            {{session()->get('succesdanger')}}
                        </div>
                        @endif

                        <div class="row">
                            @foreach ($documents as $item)
                                <div class="col-xl-3 col-sm-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <embed  src="{{url('upload',$item->imageDoc)}}" width="100px" height="100px">
                                        <h5 class="font-size-15 mb-1 text-dark">{{$item->titre}}</h5>  
                                        <a href="{{url('upload',$item->imageDoc)}}" download>Ce lien télécharge le fichier PDF</a>
                                    </div>
                                    <div class="card-footer bg-transparent border-top">
                                        <div class="contact-links d-flex font-size-20">
                                            <div class="flex-fill">
                                                <a href="{{route('repertoire.showdoc',$item->uuid)}}"><i class="bx bx-show"></i></a>
                                            </div>
                                            <div class="flex-fill">
                                                <a href="{{route('repertoire.editdoc',$item->uuid)}}"><i class="mdi mdi-pencil"></i></a>
                                            </div>
                                            <div class="flex-fill">
                                                
                                            @if (renvoiRoleUser(Auth::user()->id))
                                            <form style="display: inline-block;" action="#" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{route('repertoire.destroyDoc',$item->uuid)}}"  onclick="return confirm('Etes vous sûr de faire cette suppresion?')"><i class="far fa-trash-alt"></i></a>                                       
                                                <input name="_method" type="hidden" value="DELETE" class="far fa-trash-alt">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                
                                            </form>  
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div style="text-align: center;">
                                <nav aria-label="...">
                                        <ul class="pagination">
                                          <li class="page-item">
                                            <a class="page-link" href="{{$documents->previousPageUrl()}}">Pr&eacute;c&eacute;dent</a>
                                       
                                          </li>
                                          <li class="page-item">
                                            <a class="page-link" href="{{$documents->nextPageUrl()}}">Suivant</a>
                                          </li>
                                        </ul>
                                </nav>  
                            </div>
                            <!-- end row -->
                            
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
        
        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>
</html>
