@extends('layouts.app')
   
@section('content')
<div class="container-fluid py-4">
 <div class="row">
    <div class="col-md-12">
          <div class="card">
            <!--<div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>INPUT INVENTORY</b></p>
              </div>
            </div>-->
            <div class="card-body">        
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Edit Article</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('articles.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
            
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
                @foreach ($editdisplayarticle as $row)
                <form action="{{ url('articles/'.$row->id) }}" method="POST">
                @endforeach
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Article Code:</strong>
                                    <select class="form-control" name="categoryid" id="categoryid" style="width:100%" required>
                                            @foreach ($editdisplayarticle as $row)
                                            <option value='{{$row->catid}}'>{{$row->categoryname}}</option>
                                            @endforeach
                                            @foreach ($displaycategory as $row)
                                            <option value='{{$row->id}}'>{{$row->category_name}}</option> 
                                            @endforeach
                                    </select>    
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Article Code:</strong>
                                @foreach ($editdisplayarticle as $row)
                                <input type="text" name="code" id="code"  class="form-control" value="{{$row->code}}" >
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Article Name:</strong>
                                @foreach ($editdisplayarticle as $row)
                                <input type="text" name="article" id="article"  class="form-control" value="{{$row->article}}" required>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
