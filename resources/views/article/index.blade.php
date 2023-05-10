@extends('tabletemplate')
@section('content')
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id))
                <div class="mt-4">
                    <a href="{{route('article.create')}}" class="btn btn-primary waves-effect waves-light btn-sm">Cr&eacute;er article<i class="mdi mdi-arrow-right ms-1"></i></a>
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
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>User</th>
                      
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                        @if(!empty($articles))

                        @foreach ($articles as $item)
                            <tr>
                                <td>
                                    @if ($item->image!="")
                                        <img src="{{url('upload/',$item->image)}}" alt=""  class="rounded-circle bg-light text-danger idshowimg">
                                        @else
                                        <img src="{{asset('assets/images/companies/img-1.png')}}" alt="" height="80" class="rounded-circle bg-light text-danger  wazimg">    
                                        @endif
                                </td>
                                <td>{{couperMots($item->titre,25)}}</td>
                                <td><?php echo couperMots($item->contenu,55); ?></td>
                                <td>{{implode(',',$item->user()->get()->pluck('name')->toArray())}}</td>
                                <td>
                                    @if((renvoiRoleUser(Auth::user()->id) && renvoiIdEgliseForArticle($item->id))|| (renvoiRoleUserS(Auth::user()->id) && renvoiIdEgliseForArticle($item->id)))
                                    <a href="{{route('article.edit',$item->uuid)}}" class="btn btn-success waves-light waves-effect"><i class="mdi mdi-pencil"></i></a>
                                    @endif
                                    @if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise())
                                    <form style="display: inline-block;" action="#" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('article.delete',$item->id)}}"  onclick="return confirm('Etes vous s&ecirc;r de faire cette suppression ?')" class="btn btn-danger waves-light waves-effect"><i class="far fa-trash-alt"></i></a>
                                        <input name="_method" type="hidden" value="DELETE" class="far fa-trash-alt">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        
                                    </form>  
                                    @endif
                                </td>
                                
                            </tr>
                        @endforeach  
                        
                        @endif
   
                    </tbody>
                </table>
                <div style="text-align: center;">
                    
                   <nav aria-label="...">
                            <ul class="pagination">
                              <li class="page-item">
                                <a class="page-link" href="{{$articles->previousPageUrl()}}">Pr&eacute;c&eacute;dent</a>
                           
                              </li>
                              <li class="page-item">
                                <a class="page-link" href="{{$articles->nextPageUrl()}}">Suivant</a>
                              </li>
                            </ul>
                    </nav>  
                   
                </div>

            </div>
        </div>
    </div> <!-- end col -->
  </div> <!-- end row -->  
@endsection
