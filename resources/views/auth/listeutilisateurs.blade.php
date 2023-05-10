@extends('tabletemplate')
@section('content')
  <div class="row">
   
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="mt-4">
                    <a href="{{route('auth.register')}}" class="btn btn-primary waves-effect waves-light btn-sm">Cr&eacute;er utilisateur <i class="mdi mdi-arrow-right ms-1"></i></a>
                </div>
                @if(session()->has('success'))
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
                        <th scope="col" style="width: 70px;">Profile</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <td>Tel</td>
                        <td>Role</td>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                        @foreach ($users as $item)
                            <tr>
                                @if ($item->image!="")
                                    <td> <img class="rounded-circle avatar-xs" src="{{url('upload/',$item->image)}}" alt=""> </td>
                                    @else
                                    <td><img class="rounded-circle avatar-xs" src="{{asset('assets/images/users/avatar-1.jpg')}}" alt=""></td>
                                @endif
                                <td>{{$item->name}}</td>
                                <td>{{$item->firstname}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{implode(',',$item->roles()->get()->pluck('name')->toArray())}}</td>
                                <td>
                                    <a href="{{route('auth.edit',$item->uuid)}}" class="btn btn-success waves-light waves-effect"><i class="mdi mdi-pencil"></i></a>
                                    @if (renvoiRoleUser(Auth::user()->id))
                                    <form style="display: inline-block;" action="#" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('auth.delete',$item->id)}}"  onclick="return confirm('Are you sure?')" class="btn btn-danger waves-light waves-effect"><i class="far fa-trash-alt"></i></a>
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
                                <a class="page-link" href="{{$users->previousPageUrl()}}">Pr&eacute;c&eacute;dent</a>
                           
                              </li>
                              <li class="page-item">
                                <a class="page-link" href="{{$users->nextPageUrl()}}">Suivant</a>
                              </li>
                            </ul>
                    </nav>  
                </div>
            </div>
        </div>
    </div> <!-- end col -->
  </div> <!-- end row -->  
@endsection
