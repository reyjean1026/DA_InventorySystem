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
        
     <!--   <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>UPLOAD FILES HERE</b></p>
              </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <button id="test" name="test" class="btn btn-info btn-sm ms-auto">Download Template</button>
                        </div>
                    </div> 
                </div>   
                <div class="row"> 
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="file" class="form-control" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <button id="test" name="test" class="btn btn-success btn-sm ms-auto">Submit File</button>
                        </div>
                    </div>
                </div>      
            </div>
          </div>
        </div>

        <div></div>
      <br>-->
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>INPUT INVENTORY</b></p>
              </div>
            </div>
            <div class="card-body">        
                <form action="/storeacquired" id="inventory" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <p>Article</p>
                                    <select class="form-control" name="articleid" id="articleid" style="width:100%">
                                        <option value=''>Please Select</option> 
                                        @foreach ($displayarticle as $row)
                                        <option value='{{$row->id}}'>{{$row->article}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <p>Registered Employee?</p>
                                    <select class="form-control" name="registered" id="registered" style="width:100%">
                                        <option value=''>Please Select</option>                
                                        <option value='YES'>YES</option> 
                                        <option value='NO'>NO</option> 
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                <p>Assigned to</p>
                                    <select class="form-control" name="assignedto" id="assignedto" style="width:100%">
                                        <option value=''>Please Select</option> 
                                        @foreach ($displayemployee as $row)
                                        <option value='{{$row->id}}'>{{$row->fullname}}</option> 
                                        @endforeach
                                    </select>
                                    <input class="form-control" autocomplete="off" type="text" name="tempname" id="tempname" placeholder="Assigned Employee Name">
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <p>Description</p>
                                    <textarea class="form-control" autocomplete="off" type="text" name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                <p>Date acquired</p>
                                    <input class="form-control" autocomplete="off" type="date" name="date_acquired" id="date_acquired" value="{{ old('date_acquired') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <p>Property Number</p>
                                    <input class="form-control" autocomplete="off" type="text" name="propertynumber" id="propertynumber" placeholder="Property Number" value="{{ old('propertynumber') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <p>Quantity</p>
                                    <input class="form-control" autocomplete="off" type="number" name="unitofmeasure" id="unitofmeasure" placeholder="Quantity" value="{{ old('unitofmeasure') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <p>Unit Value</p>
                                    <input class="form-control" autocomplete="off" type="number" name="unitvalue" id="unitvalue" placeholder="Unit Value" value="{{ old('unitvalue') }}">
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                                <div class="form-group">
                                <p>Received Date</p>
                                    <input class="form-control" autocomplete="off" type="date" name="received_date" id="received_date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <p>Equipment Status</p>
                                    <select class="form-control" name="statusid" id="statusid" style="width:100%">
                                        <option value=''>Please Select</option> 
                                        <option value='SERVICIABLE'>SERVICIABLE</option> 
                                        <option value='UNSERVICIABLE'>UNSERVICIABLE</option> 
                                        <option value='WASTE'>WASTE</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <p>Remarks</p>
                                    <textarea class="form-control" autocomplete="off" type="text" name="remarks" id="remarks" placeholder="Remarks">{{ old('remarks') }}</textarea>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-success btn-sm ms-auto">Submit</button>
                                </div>
                            </div> 
                    </div>    
                </form>
            </div>
          </div>
        </div>
          
      <div></div>
      <br>
    
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>PROPERTY INFORMATION</b></p>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                        
                            <div class="m-4">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="nav-item">
                                        <a href="#fortransfer" class="nav-link active" data-bs-toggle="tab">ASSIGNED PROPERTY</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#transferto" class="nav-link" data-bs-toggle="tab">TRANSFERRED LOGS</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="fortransfer">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                            <table id="tblassignedproperty" class="display" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th hidden></th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Acquired</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Property Number</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit of Measure</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Value</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registered?</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assigned to</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Temp Name</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remarks</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                                                
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($displayproperty as $row) 
                                                                    <tr>
                                                                        <td hidden>{{$row->id}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->category}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->article}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->description}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->date_acquired}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->propertynumber}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->unitmeasure}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->value}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center"></td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->registeredstatus}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->assigned_to}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->tempname}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->status}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->remarks}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">
                                                                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('acquired/deactivate/'.$row->id) }}" onsubmit="return confirm('Are you sure you wish to delete this record?');">
                                                                            @csrf
                                                                                <a class="badge badge-sm bg-gradient-primary" href="{{ url('acquired/'.$row->id.'/edit') }}">Edit</a>
                                                                                <button type="submit" class="badge badge-sm bg-gradient-danger"> Delete</button>
                                                                                <button type="button" class="badge badge-sm bg-gradient-info btnSelect" id="ModalinputDatabaseName" data-bs-toggle="modal" data-bs-target="#exampleModal">Transfer</button>
                                                                                
                                                                        </form>   
                                                                        </td>
                                                                    </tr>   
                                                                  @endforeach                 
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th hidden></th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Acquired</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Property Number</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit of Measure</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Value</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registered?</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assigned to</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Temp Name</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remarks</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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
                                                            <table id="tbltransferredlogs" class="display" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th hidden></th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Property Number</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Received Date</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registered Status</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assigned to</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Temp Name</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remarks</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($displaytransferredlogs as $row) 
                                                                    <tr>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center" hidden>{{$row->id}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->propnumber}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->receiveddate}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->regstatus}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->assigned}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->tempname}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->remarks}}</td>
                                                                        <td class="text-secondary text-xs font-weight-bold align-middle text-center">
                                                                            <button type="button" class="badge badge-sm bg-gradient-primary btnSelect" id="ModalinputDatabaseName" data-bs-toggle="modal" data-bs-target="#exampleModal">Transfer</button>
                                                                        </td>
                                                                    </tr>
                                                                 @endforeach 
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th hidden></th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Property Number</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Received Date</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registered Status</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assigned to</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Temp Name</th>
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remarks</th>
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
                    </div>
                </div>
              </div>  
            </div>
          </div>
        </div>     
        
   
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">TRANSFER TO</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/storemodaltransfer" id="modalinventory" method="POST" enctype="multipart/form-data">
                                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                        <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                       <p>Property Number</p>
                                           <span class="form-control" id="modalpropnumber" name="modalpropnumber"></span>
                                       </div>
                                     </div>    
                                </div>
                        <div class="d-flex align-items-center">
                        </div>
                        </div>
                        <div class="card-body">
                                <input type="text" id="textid" name="textid" hidden>
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <p>Registered Employee?</p>
                                                <select class="form-control" name="transmodalregistered" id="transmodalregistered" style="width:100%" required>
                                                    <option value=''>Please Select</option>                
                                                    <option value='YES'>YES</option> 
                                                    <option value='NO'>NO</option> 
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <p>Assigned to</p>
                                                <select class="form-control" name="transmodalassignedto" id="transmodalassignedto" style="width:100%">
                                                    <option value="">Please Select</option> 
                                                    @foreach ($displayemployee as $row)
                                                    <option value='{{$row->id}}'>{{$row->fullname}}</option> 
                                                    @endforeach
                                                </select>
                                                <input class="form-control" autocomplete="off" type="text" name="transmodaltempname" id="transmodaltempname" placeholder="Assigned Employee Name">
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <p>Received Date</p>
                                                <input class="form-control" autocomplete="off" type="date" name="transmodaltransferred_date" id="transmodaltransferred_date">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <p>Equipment Status</p>
                                                <select class="form-control" name="transmodalstatusid" id="transmodalstatusid" style="width:100%" required>
                                                    <option value=''>Please Select</option> 
                                                    <option value='SERVICIABLE'>SERVICIABLE</option> 
                                                    <option value='UNSERVICIABLE'>UNSERVICIABLE</option> 
                                                    <option value='WASTE'>WASTE</option> 
                                                </select>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <p>Remarks</p>
                                                <textarea class="form-control" autocomplete="off" type="text" name="transmodalremarks" id="transmodalremarks" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                </div>
                              
                        </div>
                    </div>
                </div>
          
          </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-gradient-primary">Save changes</button>
            </div>
    </form>   
        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            $('#tblassignedproperty').DataTable({
                scrollX:        true,
                scrollCollapse: true,
                ServerSide: true,
                Processing: true,
                columnDefs: [
                    { width: 200, targets: 0 }
                ],
                fixedColumns: true
            });

            $('#tbltransferredlogs').DataTable();
           
            $("#tempname").hide();
            $("#assignedto").next().hide();

            $("#transmodaltempname").hide();
            $("#transmodalassignedto").select2();
            $("#transmodalassignedto").next().hide();
            
            $("#articleid").select2();
            $("#assignedto").select2();
            $("#assignedto").next().hide();
            $("#registered").select2();
         
            $("#transmodalregistered").select2();

            var test = $("#registered").val();
                if(test=="YES"){
                    $("#assignedto").next().show();  
                    $("#tempname").hide();
                }
                else if (test=="NO"){
                    $("#assignedto").next().hide();
                    $("#tempname").show();
                }
                else{
                    $("#tempname").hide();
                    $("#assignedto").next().hide();  
                }

            $("#registered").change(function () {
                var reg = this.value;
                if(reg=="YES"){
                    $("#assignedto").next().show();  
                    $("#tempname").hide();
                    $('#tempname').val("");
                }
                else if (reg=="NO"){
                    $("#assignedto").next().hide();
                    $("#tempname").show();
                    $("#assignedto")[0].selectedIndex ="";
                }
                else{
                    $("#tempname").hide();
                    $("#assignedto").next().hide();  
                }
            });

            $(function() {
                $('#inventory').submit(function(e) {
                    e.preventDefault();
                    var test = $("#registered").val();
                    var editassignedto = $('#assignedto').val();
                    var edittempname = $('#tempname').val();
                    if(test=="YES"){
                        if (editassignedto.length < 1) {
                        $('#assignedto').after('<span style="color:red">This field is required</span>');
                        }
                        else{
                            e.currentTarget.submit();
                        }
                    }
                    else if (test=="NO"){
                        if (edittempname.length < 1) {
                        $('#tempname').after('<span style="color:red">This field is required</span>');
                        }
                        else{
                            e.currentTarget.submit();
                        }
                    } 

                });
            });

            var test = $("#transmodalregistered").val();
                if(test=="YES"){
                    $("#transmodalassignedto").next().show();  
                    $("#transmodaltempname").hide();
                }
                else if (test=="NO"){
                    $("#transmodalassignedto").next().hide();
                    $("#transmodaltempname").show();
                }
                else{
                    $("#transmodaltempname").hide();
                    $("#transmodalassignedto").next().hide();  
                }

            $("#transmodalregistered").change(function () {
                var modalreg = this.value;
                if(modalreg=="YES"){
                    $("#transmodalassignedto").next().show();   
                    $("#transmodaltempname").hide();
                    $('#transmodaltempname').val("");
                }
                else if (modalreg=="NO"){
                    $("#transmodaltempname").show();
                    $("#transmodalassignedto").next().hide();
                }
                else{
                    $("#transmodaltempname").hide();
                    $("#transmodalassignedto").next().hide();  
                    $("#transmodalassignedto")[0].selectedIndex ="";
                }
            });

            $(function() {
                $('#modalinventory').submit(function(e) {
                    e.preventDefault();
                    var test = $("#transmodalregistered").val();
                    var editassignedto = $('#transmodalassignedto').val();
                    var edittempname = $('#transmodaltempname').val();
                    if(test=="YES"){
                        if (editassignedto.length < 1) {
                        $('#transmodalassignedto').after('<span style="color:red">This field is required</span>');
                        }
                        else{
                            e.currentTarget.submit();
                        }
                    }
                    else if (test=="NO"){
                        if (edittempname.length < 1) {
                        $('#transmodaltempname').after('<span style="color:red">This field is required</span>');
                        }
                        else{
                            e.currentTarget.submit();
                        }
                    } 

                });
            });

            
            $("#tblassignedproperty").on('click','.btnSelect',function(){
                //alert("sadasdasd");
                var currentRow=$(this).closest("tr"); 
                var id = currentRow.find("td:eq(0)").text();
                var propnum = currentRow.find("td:eq(5)").text();
                $("#textid").val(id);
                $("#modalpropnumber").html(propnum);
                
            });

            $("#tbltransferredlogs").on('click','.btnSelect',function(){
                //alert("sadasdasd");
                var currentRow=$(this).closest("tr"); 
                var id = currentRow.find("td:eq(0)").text();
                var propnum = currentRow.find("td:eq(1)").text();
                $("#textid").val(id);
                $("#modalpropnumber").html(propnum);
                
            });

        } );
    </script>
    @endsection