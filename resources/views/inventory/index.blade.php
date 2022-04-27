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
                <p class="mb-0"><b>ADD INVENTORY</b></p>
              </div>
            </div>
            <div class="card-body">
                <form action="/storeinventory" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="articleid" id="articleid" style="width:100%">
                                        <option value=''>Select Article</option> 
                                        @foreach ($displayarticle as $row)
                                        <option value='{{$row->id}}'>{{$row->article}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                </div>
                            </div> 
                      </div>
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" autocomplete="off" type="text" name="description" id="description" placeholder="Description"></textarea>
                                </div>
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="form-control" autocomplete="off" type="date" name="dateacquired" id="dateacquired" placeholder="Date Acquired">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                     <input class="form-control" autocomplete="off" type="number" name="unitofmeasure" id="unitofmeasure" placeholder="Unit of Measure">  
                                </div>
                            </div> 
                            <div class="col-md-2">
                                <div class="form-group">
                                     <input class="form-control" autocomplete="off" type="number" name="unitvalue" id="unitvalue" placeholder="Unit Value">  
                                </div>
                            </div> 
                            <div class="col-md-2">
                                <div class="form-group">
                                   <select class="form-control" name="status" id="status">
                                        <option value=''>Select Status of Inventory</option> 
                                        <option value='Equipment'>EQUIPMENT</option> 
                                        <option value='Supply'>SUPPLY</option> 
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-2">
                                <div class="form-group">
                                   <select class="form-control" name="inv_type" id="inv_type">
                                        <option value=''>Select Transfer Type</option> 
                                        <option value='Equipment'>ICS</option> 
                                        <option value='Supply'>MR</option> 
                                        <option value='Supply'>PAR</option> 
                                    </select>
                                </div>
                            </div> 
                      </div>
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-success btn-sm ms-auto">Add Inventory</button>
                                </div>
                            </div>
                      </div>
                </form>
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
                <p class="mb-0"><b>INVENTORY INFORMATION</b></p>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                        <table id="tblinventory" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category Name</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article Name</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Acquired</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit of Measure</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Value</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Available</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($displayinventory as $row)
                                <tr>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->type}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->status}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->categoryname}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->article}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->description}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->date_acquired}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">Php{{number_format($row->unit_of_measure, 2, '.', ',') }}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">{{$row->unitvalue}}</td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right">
                                      <?php
                                      $unitofmeasure = $row->unit_of_measure;
                                      $unitvalue = $row->unitvalue;
                                      $total = $unitofmeasure*$unitvalue;
                                      ?>
                                         Php{{number_format($total, 2, '.', ',') }}
                                    </td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right"></td>
                                    <td class="text-secondary text-xs font-weight-bold align-middle text-right"><button class="badge badge-sm bg-gradient-primary">Edit</button>
                                    <button class="badge badge-sm bg-gradient-danger">Deact</button>
                                    <button class="badge badge-sm bg-gradient-success">Logs</button>
                                  </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category Name</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article Name</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Acquired</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit of Measure</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Value</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Available</th>
                                    <th class="text-right text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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

    <script>
        $(document).ready(function() {
            $('#tblinventory').DataTable();
            $("#articleid").select2();
        } );
    </script>
    @endsection