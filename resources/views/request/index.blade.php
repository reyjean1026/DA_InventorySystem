@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
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
    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>PROPERTY INFORMATION</b></p>
              </div>
            </div>
            <div class="m-4">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item">
                        <a href="#fortransfer" class="nav-link active" data-bs-toggle="tab">FOR TRANSFER</a>
                    </li>
                    <li class="nav-item">
                        <a href="#transferto" class="nav-link" data-bs-toggle="tab">TRANSFER TO</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="fortransfer">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <table id="tblfortransfer" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Acquired</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Property Number</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($displayrequest as $row)
                                                            <tr>
                                                                <td><center><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></center></td>
                                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->type}}</td>
                                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->article}}</td>
                                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->description}}</td>
                                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->date_acquired}}</td>
                                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->property_number}}</td>
                                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->remarks}}</td>
                                                            </tr>
                                                        @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Acquired</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Property Number</th>
                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remarks</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                            </div>  
                        </div>
                    </div>
                    <div class="tab-pane fade" id="transferto">
                        
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                                <table id="tbltransferto" class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Type</th>
                                                            <th>Article</th>
                                                            <th>Description</th>
                                                            <th>Date Acquired</th>
                                                            <th>Measure</th>
                                                            <th>Value</th>
                                                            <th>Property Number</th>
                                                            <th>Assigned</th>
                                                            <th>Transfer to</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><button class="badge badge-sm bg-gradient-primary">Edit</button>
                                                                <button class="badge badge-sm bg-gradient-danger">Deact</button>
                                                                <button class="badge badge-sm bg-gradient-success">Logs</button>
                                                                </td>
                                                            </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Type</th>
                                                            <th>Article</th>
                                                            <th>Description</th>
                                                            <th>Date Acquired</th>
                                                            <th>Measure</th>
                                                            <th>Value</th>
                                                            <th>Property Number</th>
                                                            <th>Assigned</th>
                                                            <th>Transfer to</th>
                                                            <th>Remarks</th>
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
      </div>  <br>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>REQUESITIONER</b></p> 
              </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control" autocomplete="off" type="date" name="articlecode" id="articlecode">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control" autocomplete="off" type="text" name="articlename" id="articlename" placeholder="Location">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input class="form-control" autocomplete="off" type="text" name="articlename" id="articlename" placeholder="Assigned to">
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" autocomplete="off" type="text" name="articlename" id="articlename" placeholder="Remarks"></textarea>
                        </div>
                    </div> 
                </div>
                <div class="row">
                     <div class="col-md-3">
                        <div class="form-group">
                            <button class="btn btn-success btn-sm ms-auto">Submit</button>
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
            $('#tblfortransfer').DataTable();
            $('#tbltransferto').DataTable();
            $("#articleid").select2();
        } );
    </script>
    @endsection