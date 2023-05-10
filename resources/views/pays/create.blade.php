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

                <form action="{{ route('pays.store') }}" method="POST">
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
                            <a href="{{route('pays.index')}}" class="btn btn-primary waves-effect waves-light btn-sm">Aller à la liste <i class="mdi mdi-arrow-left ms-1"></i></a>
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
                                <label for="capitale">Capitale</label>
                                <input type="text" class="form-control"  name="capitale" placeholder="Entrer la capitale" value="{{old('capitale')}}">
                                   <span class="text-danger">@error('capitale'){{ $message }}
                                     @enderror
                                  </span>
                            </div>
                           
                           <div class="mb-3">
                                <label for="indicatif">Indicatif</label>
                                <input id="indicatif" name="indicatif" type="text" class="form-control" placeholder="Entrer indicatif" value="{{old('indicatif')}}">
                                <span class="text-danger">@error('indicatif'){{ $message }}
                                    @enderror
                                 </span>
                            </div>
                            
                        </div>

                        <div class="col-sm-6">
                            
                            <div class="mb-3">
                                <label for="reductionmax">Réduction Max</label>
                                <input type="text" class="form-control"  name="reductionmax" placeholder="Entrer reduction de plus de deux messe" value="{{old('reductionmax')}}">
                                <span class="text-danger">@error('reductionmax'){{ $message }}
                                   @enderror
                                </span>
                            </div>
                           <div class="mb-3">
                                <label for="reductionmin">Réduction Min</label>
                                <input id="reductionmin" name="reductionmin" type="text" class="form-control" placeholder="Entrer reduction de  deux messe" value="{{old('reductionmin')}}">
                                <span class="text-danger">@error('reductionmin'){{ $message }}
                                    @enderror
                                 </span>
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