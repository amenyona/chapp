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

                <form action="{{ route('eglise.update',$eglise->id) }}" method="POST">
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
                    <div class="row">
                        <div class="mt-4">
                            <a href="{{route('eglise.index')}}" class="btn btn-primary waves-effect waves-light btn-sm">Aller &agrave; la liste <i class="mdi mdi-arrow-left ms-1"></i></a>
                        </div>
                        <br>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control"  name="nom"  value="{{strtoupper($eglise->nom)}}">
                                   <span class="text-danger">@error('nom'){{ $message }}
                                     @enderror
                                  </span>
                            </div>
                            <div class="mb-3">
                                <label for="diocese">Diocese</label>
                                <input type="text" class="form-control"  name="diocese"  value="{{$eglise->diocese}}">
                                   <span class="text-danger">@error('diocese'){{ $message }}
                                     @enderror
                                  </span>
                            </div>
                            <div class="mb-3">
                                <label for="quartier">Quartier</label>
                                <input type="quartier" class="form-control"  name="quartier"  value="{{$eglise->quartier}}">
                                <span class="text-danger">@error('quartier'){{ $message }}
                                   @enderror
                                </span>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control"  name="email"  value="{{$eglise->email}}">
                                <span class="text-danger">@error('email'){{ $message }}
                                   @enderror
                                </span>
                            </div>
                          
                            
                        </div>

                        <div class="col-sm-6">
                            <!-- <div class="mb-3">
                                <label for="tel">Téléphone</label>
                                <input id="tel" name="tel" type="text" class="form-control"  value="{{$eglise->tel}}">
                                <span class="text-danger">@error('tel'){{ $message }}
                                    @enderror
                                 </span>
                            </div> -->
                            <div class="mb-3">
                                <label for="ville">Ville</label>
                                <input id="ville" name="ville" type="text" class="form-control"  value="{{$eglise->ville}}">
                                <span class="text-danger">@error('ville'){{ $message }}
                                    @enderror
                                 </span>
                            </div>
                            <div class="mb-3">
                                <label for="adresse">Adresse</label>
                                <input id="adresse" name="adresse" type="text" class="form-control"  value="{{$eglise->adresse}}">
                                <span class="text-danger">@error('adresse'){{ $message }}
                                    @enderror
                                 </span>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Pays</label>
                                <select class="form-control select2" name="pays"> 
                                    <option>Veuillez Selectionner</option>
                                    @foreach ($pays as $item)
                                    <option value="{{$item->id}}" {{ ( $item->id == $paysId) ? 'selected' : '' }}>{{$item->nom}}</option>
                                    @endforeach
                                    
                                </select>
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