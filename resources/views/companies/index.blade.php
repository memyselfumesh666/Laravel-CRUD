@extends('companies.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Company Dashboard</h2>
            </div>
            <div class="col-lg-2 margin-tb">
                <a class="btn btn-success" href="{{ route('companies.index') }}"> Company</a>
            </div>
            <div class="col-lg-2 margin-tb">
                <a class="btn btn-success" href="{{ route('employees.index') }}"> Employee</a>
            </div>
            <div class="col-lg-2 margin-tb">
                <a class="btn btn-success" href="{{ route('signout') }}"> Logout</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Create New Company</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Logo</th>
            <th>Website</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($companies as $company)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $company->name }}</td>
            <td>{{ $company->email }}</td>
            <td>
            <?php $src    = (isset($company->logo)) ? $company->logo : 'no_image.jpg';?>    
            <img src="/company_logo/<?php echo $src;?>" width="100px"></td>
            <td>{{ $company->website }}</td>
            <td>
                <form action="{{ route('companies.destroy',$company->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('companies.show',$company->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $companies->links() !!}
      
@endsection