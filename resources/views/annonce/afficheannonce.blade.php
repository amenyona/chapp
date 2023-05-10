@extends('tabletemplate')
@section('content')
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
               @if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id))
                <div class="mt-4">
                    <a href="{{route('annonce.create')}}" class="btn btn-primary waves-effect waves-light btn-sm">Cr&eacute;er annonce<i class="mdi mdi-arrow-right ms-1"></i></a>
                </div>
               @endif
                
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
               <br>
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr> 
                        <th>Titre</th>
                        <th>Libelle</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                        @foreach ($annonces as $item)
                            <tr>
                                <td>{{$item->titre}}</td>
                                <td><?php echo couperMots($item->libelle,50); ?></td>
                                <td>
                                    <a href="{{route('annonce.show',$item->id)}}" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></a>
                                    <a href="{{route('annonce.edit',$item->id)}}" class="btn btn-success waves-light waves-effect"><i class="mdi mdi-pencil"></i></a>
                                    @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id))
                                    <form style="display: inline-block;" action="#" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('annonce.delete',$item->id)}}"  onclick="return confirm('Etes vous s&ucirc;r de faire cette suppression ?')" class="btn btn-danger waves-light waves-effect"><i class="far fa-trash-alt"></i></a>
                                        <input name="_method" type="hidden" value="DELETE" class="far fa-trash-alt">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        
                                   </form>  
                                    @endif
                                  
                                </td>
                                
                            </tr>
                        @endforeach                    
   
                    </tbody>
                </table>
                <div style="text-align: center;">
                    <nav aria-label="...">
                            <ul class="pagination">
                              <li class="page-item">
                                <a class="page-link" href="{{$annonces->previousPageUrl()}}">Pr&eacute;c&eacute;dent</a>
                           
                              </li>
                              <li class="page-item">
                                <a class="page-link" href="{{$annonces->nextPageUrl()}}">Suivant</a>
                              </li>
                            </ul>
                          </nav>  

                </div>

            </div>
        </div>
    </div> <!-- end col -->
  </div> <!-- end row -->  
@endsection
