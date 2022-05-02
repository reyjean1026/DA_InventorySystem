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
                            <h2>Edit Category</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('articles.index') }}"> Back</a>
                        </div>
                    </div>
                </div>         
                @foreach ($editdisplaycategory as $row)
                <form action="{{ url('articles/category/'.$row->id) }}" method="POST">
                @endforeach
                    @csrf
                    @method('PUT')
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Category Name:</strong>
                                @foreach ($editdisplaycategory as $row)
                                <input type="text" name="category_name" id="category_name"  class="form-control" value="{{$row->category_name}}" required>
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