@extends('createedittemplate')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Rechercher Annonces Expir&eacute;es</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Annonces</a></li>
                    <li class="breadcrumb-item active">Rechercher Annonces Expir&eacute;es</li>
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

                <form action="{{route('annonce.afficherAnnonceExprirees')}}" method="POST">
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
                            <a href="{{route('annonce.index')}}" class="btn btn-primary waves-effect waves-light btn-sm">Aller &agrave; la liste <i class="mdi mdi-arrow-left ms-1"></i></a>
                        </div>
                        <br>
                        <div class="col-sm-6">
                                                       
                            <div class="mb-3">
                                <label class="control-label">Pays</label>
                                <select class="form-control select2 dynamique" name="pays" data-dependente="state" id="pays"> 
                                    <option>Veuillez S&eacute;lectionner</option>
                                    @foreach ($pays as $item)
                                    <option value="{{$item->id}}">{{$item->nom}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="control-label">&Eacute;glises</label>
                                <select class="form-control select2 church" name="eglise" dependente="church">
                                    <option value="">Veuillez S&eacute;lectionner</option>
                                </select>
                            </div>

                            
                            
                        </div>

                        
                    </div>
                    
                    
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Rechercher</button>
                        
                    </div>
                    {{ csrf_field() }}
                </form>
              
            </div>
        </div>

       
       
    </div>
</div>

@endsection