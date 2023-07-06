@extends('tabletemplate')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="mt-4">

                    <a href="#" class="btn btn-primary waves-effect waves-light btn-sm">Aller à la liste<i class="mdi mdi-arrow-left ms-1"></i></a>

                </div>
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
                <form action="{{route('telephone.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Libelle de téléponie</th>
                                <th>Numéro de téléphone</th>
                                <th><button type="button" name="add" class="btn btn-success btn-xs add"><i class="bx bx-plus"></i></button></th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary buttonSave" value="Insert" disabled="">Enregistrer</button>
                    </div>
                    <input type="hidden" value="{{$ideglise}}" name="ideglise"/>

                </form>


            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection