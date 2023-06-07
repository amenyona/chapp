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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="pt-3">
                                            <div class="row justify-content-center">
                                                <div class="col-xl-8">
                                                    <div>
                                                        <div class="text-center">
                                                            
                                                            <h4>{{$article->titre}}</h4>
                                                            <p class="text-muted mb-4"><i class="mdi mdi-calendar me-1"></i>{{date('d-m-Y', strtotime($article->created_at))}}</p>
                                                        </div>

                                                        <hr>
                                                        <div class="text-center">
                                                            <div class="row">
                                                                
                                                                <div class="col-sm-6">
                                                                    <div class="mt-4 mt-sm-0">
                                                                        <p class="text-muted mb-2">Date</p>
                                                                        <h5 class="font-size-15">{{date('d-m-Y', strtotime($article->created_at))}}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="mt-4 mt-sm-0">
                                                                        <p class="text-muted mb-2">Posté par</p>
                                                                        <h5 class="font-size-15">{{implode(',',$article->user()->get()->pluck('name')->toArray())}}  {{implode(',',$article->user()->get()->pluck('firstname')->toArray())}} / {{renvoiEgliseInfo($article->iduser)}} / {{renvoiPaysInfo($article->idEglise)}}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <div class="my-5">
                                                            @if ($article->image!="")
                                                            <img src="{{url('upload/',$article->image)}}" alt="" class="img-thumbnail mx-auto d-block">
                                                            @endif
                                                        </div>

                                                        <hr>

                                                        <div class="mt-4">
                                                            <div class="text-muted font-size-14">
                                                                <p><?php  echo $article->contenu; ?></p>
                                                            </div>

                                                            <hr>

                                                            <div class="mt-5">
                                                                <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Commentaires :</h5>
                                                                
                                                                <div>

                                                                    @foreach ($commentaires as $item)

                                                                    <div class="media py-3 border-top">
                                                                        <div class="avatar-xs me-3">
                                                                            @if (renvoiCommentUserId($item->id)!="")
                                                                            <td> <img  class="img-fluid d-block rounded-circle" src="{{url('upload/',renvoiCommentUserId($item->id))}}" alt=""> </td>
                                                                            @else
                                                                            <td><img  class="img-fluid d-block rounded-circle" src="{{asset('assets/images/users/avatar-2.jpg')}}" alt=""></td>
                                                                           @endif
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <h5 class="font-size-14 mb-1">{{renvoiUserName($item->iduser)}} <small class="text-muted float-end">{{date('d-m-Y', strtotime($item->created_at))}}</small></h5>
                                                                            <p class="text-muted"><?php echo $item->contenu; ?></p>

                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                        
                                                                </div>
                                                            </div>
                
                                                            <div class="mt-4">
                                                                <h5 class="font-size-16 mb-3">Qu'est-ce-que cette exhortation vous dis? Faites nous savoir.</h5>
                
                                                                <form action="{{route('article.saveCommentaire')}}" method="POST">
                                                                     @csrf
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

                
                                                                    <div class="mb-3">
                                                                        <label for="commentmessage-input" class="form-label">Message</label>
                                                                        <textarea class="form-control" id="commentmessage-input" placeholder="Votre message..." rows="3" name="contenu" required></textarea>
                                                                        <span class="text-danger">@error('contenu'){{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                    </div>
                                                                    <input type="hidden" name="idarticle" value="{{$article->id}}"/>
                
                                                                    <div class="text-end">
                                                                        <button type="submit" class="btn btn-success w-sm">Envoyer Votre Commentaire</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
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

        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>
</html>
