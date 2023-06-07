@extends('createedittemplate')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Modifier {{$repertoire->nom}}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{$repertoire->nom}}</a></li>
                    <li class="breadcrumb-item active">Modifier {{$repertoire->nom}}</li>
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

                <form action="{{route('repertoire.update',$repertoire->uuid)}}" method="POST">
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
                            <a href="{{route('repertoire.index')}}" class="btn btn-primary waves-effect waves-light btn-sm">Aller à la liste <i class="mdi mdi-arrow-left ms-1"></i></a>
                        </div>
                        <br>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="name">Nom Du répertoire</label>
                                <input type="text" class="form-control"  name="nom" value="{{$repertoire->nom}}" required>
                                   <span class="text-danger">@error('nom'){{ $message }}
                                     @enderror
                                  </span>
                            </div>
                           
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="textarea"  class="form-control" maxlength="225" rows="3"
                                                placeholder="This textarea has a limit of 225 chars." required>{{$repertoire->description}}</textarea>
                                   <span class="text-danger">@error('description'){{ $message }}
                                     @enderror
                                  </span>
                                  <input type="hidden" name="idrepertoire" value="{{$repertoire->id}}" >
                            </div>
                            
                        </div>

                        
                    </div>
                    
                    
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                    </div>
                    
                </form>
              
            </div>
        </div>

       
       
    </div>
</div>

@endsection