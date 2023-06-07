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

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php if(isset($repertoires) && !empty($repertoires)){?>
                <?php foreach ($repertoires as $dat): ?>
          ['<?php echo $dat->nom; ?>',  <?php echo renvoieCarnetDeBapteme($dat->type); ?>],
               
          <?php endforeach; ?>
          <?php }?>
        ]);

        var options = {
          title: 'Nos Fichiers Par Dossiers'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
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
                                    <h4 class="mb-sm-0 font-size-18">Notre Classeur</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item">Dossiers</li>
                                            <li class="breadcrumb-item active">Notre Classeur</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="d-xl-flex">
                            <div class="w-100">
                                <div class="d-md-flex">
                                    <div class="card filemanager-sidebar me-md-2">
                                        <div class="card-body">
        
                                            <div class="d-flex flex-column h-100">
                                                <div class="mb-4">
                                                    <div class="mb-3">
                                                        <div class="dropdown">
                                                            <button class="btn btn-light dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="mdi mdi-plus me-1"></i> Créer Nouveau Dossier
                                                            </button>
                                                            <div class="dropdown-menu">
                                                              <a class="dropdown-item" href="{{route('repertoire.create')}}"><i class="bx bx-folder me-1"></i>Nouveau Dossier</a>
                                                             
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
        
                                                <div class="mt-auto">
                                                    <div class="alert alert-success alert-dismissible fade show px-3 mb-0" role="alert">
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        <div class="mb-3">
                                                            <i class="bx bxs-folder-open h1 text-success"></i>
                                                        </div>
        
                                                        <div>
                                                            <h5 class="text-success">Gestion Electronique De Vos Documents</h5>
                                                            <p>Bien classer des documents est une bonne manière de faire. </p>
                                                           
                                                        </div>
                                                    </div>
        
                                                    
                                                </div>
                                            </div>
        
                                        </div>
                                    </div>
                                    <!-- filemanager-leftsidebar -->
        
                                    <div class="w-100">
                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    <div class="row mb-3">
                                                        <div class="col-xl-3 col-sm-6">
                                                            <div class="mt-2">
                                                                <h6><b>Nos Dossiers</b></h6>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                </div>

                                                <div>
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
                                                        @foreach ($repertoires as $item)
                                                         <div class="col-xl-4 col-sm-6">
                                                            <div class="card shadow-none border">
                                                                <div class="card-body p-3">
                                                                    <div class="">
                                                                        <div class="float-end ms-2">
                                                                            <div class="dropdown mb-2">
                                                                                <a class="font-size-16 text-muted dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                                                </a>
                                                                                
                                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                                    <a class="dropdown-item" href="{{route('repertoire.listeFiles',$item->uuid)}}">Ouvrir</a>
                                                                                    <a class="dropdown-item" href="{{route('repertoire.edit',$item->uuid)}}">Modifier</a>
                                                                                    <div class="dropdown-divider"></div>
                                                                                    <a class="dropdown-item" href="#">Remove</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="avatar-xs me-3 mb-3">
                                                                            <div class="avatar-title bg-transparent rounded">
                                                                                <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex">
                                                                            <div class="overflow-hidden me-auto">
                                                                                <h5 class="font-size-14 text-truncate mb-1"><a href="{{route('repertoire.listeFiles',$item->uuid)}}" class="text-body">{{$item->nom}}</a></h5>
                                                                                <p class="text-muted text-truncate mb-0">{{renvoieCarnetDeBapteme($item->type)}} Fichiers</p>
                                                                            </div>
                                                                           
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
                                                                        <a class="page-link" href="{{$repertoires->previousPageUrl()}}">Pr&eacute;c&eacute;dent</a>
                                                                   
                                                                      </li>
                                                                      <li class="page-item">
                                                                        <a class="page-link" href="{{$repertoires->nextPageUrl()}}">Suivant</a>
                                                                      </li>
                                                                    </ul>
                                                            </nav>  
                                                        </div>
                                                       
        
                                                    
        
                                                    </div>
                                                    <!-- end row -->
                                                </div>
        
                                               
                                            </div>
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end w-100 -->
                                </div>
                            </div>

                            <div class="card filemanager-sidebar ms-lg-2">
                                <div class="card-body">
                                    <div class="text-center">
                                       
                                        <div id="piechart" style="width: 300px; height: 300px;"></div>

                                        
                                    </div>


                                        <div class="card border shadow-none mb-2">
                                                <div class="p-2">
                                                    <div class="d-flex">
                                                        <div class="avatar-xs align-self-center me-2">
                                                            <div class="avatar-title rounded bg-transparent text-primary font-size-20">
                                                                <i class="mdi mdi-file-document"></i>
                                                            </div>
                                                        </div>

                                                        <div class="overflow-hidden me-auto">
                                                            <h5 class="font-size-13 text-truncate mb-1">Documents</h5>
                                                            <p class="text-muted text-truncate mb-0">{{renvoieDocumentTotal()}} Fichiers</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            
                                        </div>

                                        <div class="card border shadow-none">
                                            
                                                <div class="p-2">
                                                    <div class="d-flex">
                                                        <div class="avatar-xs align-self-center me-2">
                                                            <div class="avatar-title rounded bg-transparent text-warning font-size-20">
                                                                <i class="mdi mdi-folder"></i>
                                                            </div>
                                                        </div>

                                                        <div class="overflow-hidden me-auto">
                                                            <h5 class="font-size-13 text-truncate mb-1">Dossiers</h5>
                                                            <p class="text-muted text-truncate mb-0">{{renvoiDossierTotal()}} Dossiers</p>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                           
                                        </div>
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

        <!-- apexcharts -->
        <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- file-manager js -->
        <script src="{{asset('assets/js/pages/file-manager.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>
</html>
