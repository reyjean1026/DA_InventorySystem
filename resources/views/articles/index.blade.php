@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
      <div class="row">
      @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>CATEGORY INFORMATION</b></p>
              </div>
            </div>
            <div class="card-body">
                <form action="/storecategory" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                        <input class="form-control" autocomplete="off" type="text" name="categoryname" id="categoryname" placeholder="Category Name" value="{{ old('categoryname') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button class="btn btn-success btn-sm ms-auto">Add Category</button>
                                    </div>
                                </div> 
                            </div>
                </form>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                        <table id="tblcategory" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($displaycategory as $row)
                                <tr>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->category_name}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-center">
                                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('articles/deactivatecategory/'.$row->id) }}"onsubmit="return confirm('Are you sure you wish to delete this record?');">
                                        @csrf
                                            <a class="badge badge-sm bg-gradient-primary" href="{{ url('articles/'.$row->id.'/editcategory') }}">Edit</a>
                                            <button type="submit" class="badge badge-sm bg-gradient-danger"> Delete</button>
                                        </form>                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
              </div>  
            </div>
          </div>
        </div>
          
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>ARTICLE INFORMATION</b></p>
              </div>
            </div>
            <div class="card-body">
                 <form action="/storearticle" method="POST">
                     @csrf
                    <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" name="categoryid" id="categoryid" style="width:100%">
                                        <option value=''>Select Category</option> 
                                        @foreach ($displaycategory as $row)
                                        <option value='{{$row->id}}'>{{$row->category_name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control" autocomplete="off" type="text" name="articlecode" id="articlecode" placeholder="Article Code" value="{{ old('articlecode') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control" autocomplete="off" type="text" name="articlename" id="articlename" placeholder="Article Name" value="{{ old('articlename') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button class="btn btn-success btn-sm ms-auto">Add Article</button>
                                </div>
                            </div> 
                        </div>
                </form>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                        <table id="tblarticle" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article Code</th> -->
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-6">Category</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-6">Article Name</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($displayarticle as $row)
                                <tr>
                                     <!-- <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->code}}</td> -->
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->categoryname}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->article}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">         
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('articles/deactivate/'.$row->id) }}"onsubmit="return confirm('Are you sure you wish to delete this record?');">
                                        @csrf
                                            <a class="badge badge-sm bg-gradient-primary" href="{{ url('articles/'.$row->id.'/edit') }}">Edit</a>
                                            <button type="submit" class="badge badge-sm bg-gradient-danger"> Delete</button>
                                    </form>   
                                </tr>
                            @endforeach                                  
                            </tbody>
                            <tfoot>
                                <tr>
                                     <!-- <th>Article Code</th> -->
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-6">Category</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-6">Article Name</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-6">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
              </div>  
            </div>
          </div>
        </div>     
      </div>   
    </div>
           
</div>
    <script>
        $(document).ready(function() {
            $('#tblcategory').DataTable();
            $('#tblarticle').DataTable();
            $("#categoryid").select2();

         
        } );
    </script>
    @endsection