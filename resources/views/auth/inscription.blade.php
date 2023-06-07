<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Inscription | La Sainte Messe- Admin</title>
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

    </head>

    <body>
        
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Inscription Gratuite</h5>
                                            <p>Obtenez votre compte  gratuit maintenant.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{asset('assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <!--div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{asset('assets/images/logo.svg')}}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div-->
                                <div class="p-2">
                                    <form class="needs-validation"  action="{{route('auth.saveUser')}}"  method="POST">
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
            
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="useremail" placeholder="Entrer email" name="email" required>  
                                             <span class="text-danger">@error('email'){{ $message }}
                                                                       @enderror
                                             </span>      
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstname" placeholder="Entrer nom" name="firstname" required>
                                              <span class="text-danger">@error('firstname'){{ $message }}
                                                            @enderror
                                              </span> 
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" placeholder="Entrer nom" name="lastname" required>
                                             <span class="text-danger">@error('lastname'){{ $message }}
                                               @enderror
                                             </span> 
                                        </div>
                                         <div class="mb-3">
                                        <label for="username" class="form-label">Eglises</label>
                                        <select class="form-control select2" name="eglise" required>
                                           <option>Veuillez Selectionner</option>
                                            @foreach ($egliseInfos as $item)
                                            <option value="{{$item->idEglise}}">{{$item->paysnom}}-{{$item->eglisenom}}-{{$item->eglisequartier}}</option>    
                                            @endforeach
                                        </select>
                                         <span class="text-danger">@error('eglise'){{ $message }}
                                               @enderror
                                             </span> 
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="userpassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="userpassword" placeholder="Enter password" required name="password">
                                            <span class="text-danger">
                                               @error('password'){{ $message }}
                                              @enderror
                                            </span>    
                                        </div>
                                        
                                         <div class="mb-3">
                                            <label for="new_confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control"  name="new_confirm_password" placeholder="Confirmer le mot de passe">
                                            <span class="text-danger">@error('new_confirm_password'){{ $message }}@enderror</span>
                                        </div>
                                        
                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">S'inscrire</button>
                                        </div>

                                        <!--div class="mt-4 text-center">
                                            <h5 class="font-size-14 mb-3">Sign up using</h5>
            
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                                        <i class="mdi mdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                                        <i class="mdi mdi-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                                        <i class="mdi mdi-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div-->
                
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">En vous inscrivant, vous acceptez les conditions d'utilisation de La Sainte Messe <!--a href="#" class="text-primary">Terms of Use</a--></p>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <p>Vous avez déjà un compte ? <a href="{{route('auth.back')}}" class="fw-medium text-primary"> Connecter</a> </p>
                                <p>© 2021 Edem LATE<i class="mdi mdi-heart text-danger"></i></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- validation init -->
        <script src="{{asset('assets/js/pages/validation.init.js')}}"></script>
        
        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>
</html>
