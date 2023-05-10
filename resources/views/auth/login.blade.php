@extends('passlog')
@section('content')

<div class="row g-0">
                
    <div class="col-xl-9" >
        <div class="auth-full-bg pt-lg-5 p-4" style="background-color: transparent;">
            <div class="w-100">
                <!--div class="bg-overlay"></div-->
                <!--div class="d-flex h-100 flex-column">

                    <div class="p-4 mt-auto">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="text-center">
                                    

                                    <div dir="ltr">
                                        <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel" style="color: #fff;">
                                            <div class="item">
                                                <div class="py-3">
                                                    <p class="font-size-16 mb-4" style="color:#fff;">" Mais le fruit de l'Esprit, c'est l'amour, la joie, la paix, la patience, la bonté, la bénignité, la fidélité, la douceur, la tempérance. "</p>

                                                    <div>
                                                        <h4 class="font-size-16 text-primary">Galates 5:22 </h4>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="item">
                                                <div class="py-3">
                                                    <p class="font-size-16 mb-4">" Et maintenant je vais &agrave; toi, et je dis ces choses dans le monde, afin qu'ils aient en eux ma joie parfaite. "</p>

                                                    <div>
                                                        <h4 class="font-size-16 text-primary">Jean 17:13</h4>
                                                       
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div-->
            </div>
        </div>
    </div>
    <!-- end col -->

    <div class="col-xl-3" style="background-color: hsla(0, 0%, 100%, 0.9) !important;">
        <div class="auth-full-page-content p-md-5 p-4">
            <div class="w-100">

                <div class="d-flex flex-column h-100">
                    <!--div class="mb-4 mb-md-5">
                        <a href="index.html" class="d-block auth-logo">
                            <img src="assets/images/logo-dark.png" alt="" height="18" class="auth-logo-dark">
                            <img src="assets/images/logo-light.png" alt="" height="18" class="auth-logo-light">
                        </a>
                    </div-->
                    <form method="POST" action="{{ route('login') }}">
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
                     <div class="my-auto">
                        
                        <div>
                            <h5 class="">Esaïe 8:13 !</h5>
                            <p class="">C'est l'Éternel des armées que vous devez sanctifier, c'est lui que vous devez craindre et redouter.</p>
                        </div>

                        <div class="mt-4">
                         

                                <div class="mb-3">
                                    <label for="email" class="form-label" >Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{old('email')}}">
                                    <span class="text-danger">@error('email') {{ $message }}
                                        
                                    @enderror</span>
                                </div>
        
                                <div class="mb-3">
                                    <div class="float-end">
                                        <!--a href="auth-recoverpw-2.html" class="text-muted">Mot de passe oublié?</a-->
                                    </div>
                                    <label class="form-label">Mot de passe</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" name="password" value="{{old('password')}}">
                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        
                                    </div>
                                    <span class="text-danger">@error('password') {{ $message }}
                                            
                                        @enderror</span>
                                </div>
        
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                    <label class="form-check-label" for="remember-check">
                                        Me souvenir
                                    </label>
                                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                                </div>
                                
                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Connecter vous</button>
                                </div>
    
                                
                                <!--div class="mt-4 text-center">
                                    <h5 class="font-size-14 mb-3">Sign in with</h5>
    
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

                            </form>
                            <div class="mt-5 text-center">
                                <p>Vous n'avez pas de compte ? <a href="#" class="fw-medium"> S'inscrire maintenant  </a> </p>
                            </div>
                        </div>
                    </div>   
                   
                    

                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Géoffroy LATE <i class="mdi mdi-heart text-danger"></i></p>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

@endsection