@extends('admin')
@section('content')
     <!-- start page title -->
     <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tableau de bord</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        
                        <li class="breadcrumb-item active">Tableau de bord</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
    @endif

    @if (session()->has('errorDanger'))
    <div class="alert alert-danger">
     {{session()->get('errorDanger')}}
    </div>
    @endif
    
    <div class="row">
        <div class="col-xl-4">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">Bienvenue !</h5>
                                <p>Tableau de bord De La Sainte Messe</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="avatar-md profile-user-wid mb-4">
                                  @if ($loggedUserInfo->image!="")
                                <img src="{{url('upload/',$loggedUserInfo->image)}}" alt="" class="img-thumbnail rounded-circle" style="height: 30px;width: 30px;">
                                @else
                                     <img class="img-thumbnail rounded-circle" src="{{asset('assets/images/users/avatar-1.jpg')}}"
                                        alt="Header Avatar">
                                @endif
                            </div>
                            
                        </div>

                        <div class="col-sm-8">
                            <div class="pt-4">

                               
                                <div class="mt-4">
                                    <a href="{{route('auth.profile',$loggedUserInfo->uuid)}}" class="btn btn-primary waves-effect waves-light btn-sm">Complèter|Voir Le Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-xl-8">
            <div class="row">
                @if (renvoiRoleUser(session('LoggedUser')) || renvoiRoleUserP(session('LoggedUser'))|| renvoiRoleUserS(session('LoggedUser')) )
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted fw-medium">Nombre d'actualités publiées</p>
                                    <h4 class="mb-0">{{renvoiActualitesNumbers(session('LoggedUser'))}}</h4>
                                </div>
                                        <img src="{{asset('assets/images/icons8-news-48.png')}}" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                 @if (renvoiRoleUser(session('LoggedUser')) || renvoiRoleUserP(session('LoggedUser'))|| renvoiRoleUserS(session('LoggedUser')) )
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted fw-medium">Nombre de commentaires envoyés</p>
                                    <h4 class="mb-0">{{renvoiCommentaireNumbers(session('LoggedUser'))}}</h4>
                                </div>

                               <img src="{{asset('assets/images/icons8-comments-48.png')}}" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                 @if (renvoiRoleUser(session('LoggedUser')) || renvoiRoleUserP(session('LoggedUser'))|| renvoiRoleUserS(session('LoggedUser')) )
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted fw-medium">Nombre Total d'inscrits</p>
                                    <h4 class="mb-0">{{renvoiUsers(session('LoggedUser'))}}</h4>
                                </div>
                                <img src="{{asset('assets/images/icons8-users-48.png')}}" alt="" title="">

                              
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
            <!-- end row -->

            
        </div>
    </div>
    @if (renvoiRoleUser(session('LoggedUser')) || renvoiRoleUserP(session('LoggedUser'))|| renvoiRoleUserS(session('LoggedUser')) )
    <div class="col-xl-12">
    <div class="card">
                <div class="card-body">
                                      <!--div id="stacked-column-chart" class="apex-charts" dir="ltr"></div-->
                    <div id="chart_div" style="width: 900px; height: 500px;"></div>
                </div>
            </div>
        </div>
        @endif
    <!-- end row -->

   
    <!-- end row -->

   
    <!-- end row -->
@endsection

