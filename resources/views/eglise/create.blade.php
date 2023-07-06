@extends('createedittemplate')
@section('content')
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('eglise.store') }}" method="POST">
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
                    <div class="row">
                        <div class="mt-4">
                            <a href="{{route('eglise.index')}}" class="btn btn-primary waves-effect waves-light btn-sm">Aller &agrave; la liste <i class="mdi mdi-arrow-left ms-1"></i></a>
                        </div>
                        <br>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control"  name="nom" placeholder="Entrer le nom" value="{{old('nom')}}">
                                   <span class="text-danger">@error('nom'){{ $message }}
                                     @enderror
                                  </span>
                            </div>
                            <div class="mb-3">
                                <label for="diocese">Dioc&egrave;se</label>
                                <input type="text" class="form-control"  name="diocese" placeholder="Entrer le dioc&egrave;se" value="{{old('diocese')}}">
                                   <span class="text-danger">@error('diocese'){{ $message }}
                                     @enderror
                                  </span>
                            </div>
                            <div class="mb-3">
                                <label for="quartier">Quartier</label>
                                <input type="text" class="form-control"  name="quartier" placeholder="Entrer le quartier" value="{{old('quartier')}}">
                                <span class="text-danger">@error('quartier'){{ $message }}
                                   @enderror
                                </span>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control"  name="email" placeholder="Entrer email" value="{{old('email')}}">
                                <span class="text-danger">@error('email'){{ $message }}
                                   @enderror
                                </span>
                            </div>
                            <div class="mb-3">
                                <label for="lastname">Nom Utilisateur</label>
                                <input type="text" class="form-control"  name="lastname" placeholder="Entrer le nom" value="{{old('lastname')}}">
                                   <span class="text-danger">@error('lastname'){{ $message }}
                                     @enderror
                                  </span>
                            </div>
                            <div class="mb-3">
                                <label for="firstname">Prénom Utilisateur</label>
                                <input type="text" class="form-control"  name="firstname" placeholder="Entrer le prénom" value="{{old('firstname')}}">
                                   <span class="text-danger">@error('firstname'){{ $message }}
                                     @enderror
                                  </span>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email Utilisateur</label>
                                <input type="email" class="form-control"  name="emailuser" placeholder="Entrer email" value="{{old('emailuser')}}">
                                <span class="text-danger">@error('emailuser'){{ $message }}
                                   @enderror
                                </span>
                            </div>
                           
                            <div class="mb-3">
                                <label class="control-label">Sexe Utilisateur</label>
                                <input id="adresse" name="sexe" type="text" class="form-control"  value="Masculin" readonly>
                                
                            </div>
                          
                            
                        </div>

                        <div class="col-sm-6">
                               <div class="mb-3">
                                <label for="tel">Téléphone Eglise</label>
                                <input id="tel" name="tel" type="text" class="form-control" placeholder="Entrer le téléphone" value="{{old('tel')}}">
                                <span class="text-danger">@error('tel'){{ $message }}
                                    @enderror
                                 </span>
                            </div>
                            <div class="mb-3">
                                <label for="ville">Ville Eglise</label>
                                <input id="ville" name="ville" type="text" class="form-control" placeholder="Entrer la ville" value="{{old('ville')}}">
                                <span class="text-danger">@error('ville'){{ $message }}
                                    @enderror
                                 </span>
                            </div>
                            <div class="mb-3">
                                <label for="adresse">Adresse Eglise</label>
                                <input id="adresse" name="adresse" type="text" class="form-control" placeholder="Entrer l'adresse" value="{{old('adresse')}}">
                                <span class="text-danger">@error('adresse'){{ $message }}
                                    @enderror
                                 </span>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Pays Eglise</label>
                                <select class="form-control select2" name="pays"> 
                                    <option>Veuillez Selectionner</option>
                                    @foreach ($pays as $item)
                                    <option value="{{$item->id}}">{{$item->nom}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="phone">Téléphone Utilisateur</label>
                                <input id="phone" name="phone" type="text" class="form-control" placeholder="Entrer phone" value="{{old('phone')}}">
                                <span class="text-danger">@error('phone'){{ $message }}
                                    @enderror
                                 </span>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Roles Utilisateur</label>
                                <select class="form-control select2" name="role"> 
                                    <option>Veuillez Selectionner</option>
                                    @foreach ($roles as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="horizontal-password-input" name="password" placeholder="Entrer le mot de passe" value="{{old('password')}}">
                                <span class="text-danger">@error('password'){{ $message }}
                                    
                                @enderror</span>
                            </div>

                            <div class="mb-3">
                                <label for="password">Confirm Password</label>
                                <input type="password" class="form-control"  name="new_confirm_password" placeholder="Confirmer le mot de passe">
                                <span class="text-danger">@error('new_confirm_password'){{ $message }}
                                    
                                @enderror</span>
                            </div>
                            
                            
                        </div>
                    </div>
                    
                    
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
                    </div>
                    
                </form>
              
            </div>
        </div>

       
       
    </div>
</div>

@endsection