@extends('tabletemplate')
@section('content')
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
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
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Contenu</th>
                        <th>Article</th>
                      
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                        @foreach ($commentaires as $item)
                            <tr>
                                <td>{{renvoiUserName($item->iduser)}}</td>
                                <td>{{renvoiUserEmail($item->iduser)}}</td>     
                                <td>{{couperMots($item->contenu,25)}}</td>
                                <td>{{couperMots(renvoiArticleTitre($item->articleId),25)}}</td>
                                
                                
                                <td>
                                    <a href="{{route('commentaire.show',$item->uuid)}}" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></a>
                                    @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id))
                                    <form style="display: inline-block;" action="#" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('commentaire.delete',$item->id)}}"  onclick="return confirm('Etes vous s&ucirc;r de faire cette suppression ?')" class="btn btn-danger waves-light waves-effect"><i class="far fa-trash-alt"></i></a>
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
                                <a class="page-link" href="{{$commentaires->previousPageUrl()}}">Pr&eacute;c&eacute;dent</a>
                           
                              </li>
                              <li class="page-item">
                                <a class="page-link" href="{{$commentaires->nextPageUrl()}}">Suivant</a>
                              </li>
                            </ul>
                          </nav>           
                 </div>   

            </div>
        </div>
    </div> <!-- end col -->
  </div> <!-- end row -->  
@endsection
