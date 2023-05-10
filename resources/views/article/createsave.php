<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Create Task | Skote - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
      
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

            
            <header id="page-topbar">
                <div class="navbar-header">
                    @include('header')
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

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
                                    <h4 class="mb-sm-0 font-size-18">Créer Article</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Articles</a></li>
                                            <li class="breadcrumb-item active">Créer Article</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            @if (renvoiRoleUser(session('LoggedUser')))
                                <div class="mt-4">
                                    <a href="{{route('article.index')}}" class="btn btn-primary waves-effect waves-light btn-sm">Aller à la liste<i class="mdi mdi-arrow-left ms-1"></i></a>
                                </div>
                            @endif
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
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
                                                        <label for="titre" class="col-form-label col-lg-2">Titre</label>
                                                        <div class="col-lg-10">
                                                            <input id="titre" name="titre" type="text" class="form-control" placeholder="Entrer Titre...">
                                                            <span class="text-danger">@error('titre'){{ $message }}
                                                                @enderror
                                                             </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label class="col-form-label col-lg-2">Contenu</label>
                                                        <div class="col-lg-10">
                                                            <textarea id="taskdesc-editor" name="contenu"></textarea>
                                                        </div>
                                                        <span class="text-danger">@error('contenu'){{ $message }}
                                                            @enderror
                                                         </span>
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <label class="col-form-label col-lg-2">Catégories</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-select dynamique" name="categorie">
                                                                <option>Selectionner les catégories</option>
                                                                @foreach ($categories as $item)
                                                                     <option value={{$item->id}}>{{$item->titre}}</option>  
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger">@error('categorie'){{ $message }}
                                                                @enderror
                                                             </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label class="col-form-label col-lg-2">Paramètre</label>
                                                        <div class="col-lg-10">
                                                            <select class="form-select souscategorie" name="souscategorie" dependente="les sous-catégories">
                                                                <option>Selectionner les sous-catégories</option>                               
                                                            </select>
                                                            <span class="text-danger">@error('souscategorie'){{ $message }}
                                                                @enderror
                                                             </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label class="col-form-label col-lg-2">Image à la une</label>
                                                        <div class="col-lg-10">
                                                            <input class="form-control" type="file" id="formFile" name="image">
                                                            <span class="text-danger">@error('image'){{ $message }}
                                                                @enderror
                                                             </span>
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
        
        <!-- form repeater js -->
        <script src="{{asset('assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/task-create.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>
        

    </body>
</html>
<script>
    $(document).ready(function(){
        $('.dynamique').change(function(){
            
            if($(this).val()!=''){
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent  = $('.souscategorie').attr('dependente');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url : "{{route('categorie.fetch')}}",
                    method : "POST",
                    data:{select:select, value:value, _token:_token,dependent:dependent},
                    
                    success:function(result){
                        $('.souscategorie').html(result)
                    }

                    })
            }
        })
    })
</script>