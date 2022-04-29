@extends('acquired.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Inventory</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('acquired.index') }}"> Back</a>
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
    @foreach ($displayproperty as $row)
    <form action="{{ url('acquired/'.$row->id) }}" method="POST">
    @endforeach
        @csrf
        @method('PUT')
      
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Article:</strong>
                         <select class="form-control" name="categoryid" id="categoryid" style="width:100%">
                                 @foreach ($displayproperty as $row)
                                <option value='{{$row->articleid}}'>{{$row->article}}</option>
                                 @endforeach
                                @foreach ($displayarticle as $row)
                                <option value='{{$row->id}}'>{{$row->article}}</option> 
                                @endforeach
                        </select>    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection