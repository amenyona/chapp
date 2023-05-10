<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>La Sainte Messe-{{$tableau['liste']}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" type="image/ico" href="{{asset('assets/images/logomissa.jpg')}}" />
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
                @include('sidebar')
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{$tableau['table']}}</a></li>
                                            <li class="breadcrumb-item active">{{$tableau['liste']}}</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-9 col-lg-8">
                                <div class="card">
                                    <!-- Nav tabs -->

                                    <!-- Tab panes -->
                                    <div class="tab-content p-4">
                                        <div class="tab-pane active" id="all-post" role="tabpanel">
                                            <div>
                                                <div class="row justify-content-center">
                                                    <div class="col-xl-8">
                                                        <div>
                                                            <div class="row align-items-center">
                                                                <div class="col-4">
                                                                    <div>
                                                                        <h5 class="mb-0">{{$tableau['table']}}</h5>
                                                                    </div>
                                                                </div>
                                    
                                                            </div>
                                                            <!-- end row -->

                                                            <hr class="mb-4">
                                                            @foreach ($articles as $item)
                                                            <div>
                                                                <h5><a href="blog-details.html" class="text-dark">{{$item->titre}}</a></h5>
                                                                <p class="text-muted">{{date('d-m-Y', strtotime($item->created_at))}}</p>
                                                                
                                                                <div class="position-relative mb-3">
                                                                    @if ($item->image!="")
                                                                    <img src="{{url('upload/',$item->image)}}" alt="" class="img-thumbnail">
                                                                    @endif
                                                                </div>

                                                                <ul class="list-inline">
                                                                    <li class="list-inline-item me-3">
                                                                      
                                                                            <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> {{implode(',',$item->user()->get()->pluck('name')->toArray())}}  {{implode(',',$item->user()->get()->pluck('firstname')->toArray())}} / {{renvoiEgliseInfo($item->iduser)}}
                                                                       
                                                                    </li>
                                                                    <li class="list-inline-item me-3">
                                                                      
                                                                            <i class="bx bx-comment-dots align-middle text-muted me-1"></i>Commentaires:{{renvoiNumbers($item->id)}}
                                                                       
                                                                    </li>
                                                                </ul>
                                                                <p><?php echo  couperMots($item->contenu,50); ?></p>

                                                                <div>
                                                                    <a href="{{route('article.show',$item->uuid)}}" class="text-primary">Lire Plus <i class="mdi mdi-arrow-right"></i></a>
                                                                </div>
                                                            </div> 
                                                            <hr class="my-5">  
                                                            @endforeach 
                                                            <div style="text-align: center;">
                                                                <nav aria-label="...">
                                                                    <ul class="pagination">
                                                                      <li class="page-item">
                                                                        <a class="page-link" href="{{$articles->previousPageUrl()}}">Précédent</a>
                                                                   
                                                                      </li>
                                                                      <li class="page-item">
                                                                        <a class="page-link" href="{{$articles->nextPageUrl()}}">Suivant</a>
                                                                      </li>
                                                                    </ul>
                                                                  </nav>           
                                                                 
                                                            </div>                                                        

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    
                                </div>
                            </div>

                            <!--couper -->
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

        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>
</html>
