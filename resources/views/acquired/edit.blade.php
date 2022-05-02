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
                            <h2>Edit Inventory</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('acquired.index') }}"> Back</a>
                        </div>
                    </div>
                </div>     
             @foreach ($displayproperty as $row)
            <form action="{{ url('acquired/'.$row->id) }}" id="editinventory" method="POST">
            @endforeach
                @csrf
                @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Article:</strong>
                            <select class="form-control" name="editarticleid" id="editarticleid" style="width:100%" required>
                                    @foreach ($displayproperty as $row)
                                    <option value='{{$row->articleid}}'>{{$row->article}}</option>
                                    @endforeach
                                    @foreach ($displayarticle as $row)
                                    <option value='{{$row->id}}'>{{$row->article}}</option> 
                                    @endforeach
                            </select>    
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Registered Employee?:</strong>
                        <select class="form-control" name="editregistered" id="editregistered" style="width:100%" required>
                            @foreach ($displayproperty as $row)
                            <option value='{{$row->registeredstatus}}'>{{$row->registeredstatus}}</option> 
                            @endforeach               
                            <option value='YES'>YES</option> 
                            <option value='NO'>NO</option> 
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Assigned to:</strong>
                        <select class="form-control" name="editassignedto" id="editassignedto" style="width:100%">
                            <option value="">Assigned to</option> 
                            @foreach ($displayemployee as $row)
                            <option value='{{$row->id}}'>{{$row->fullname}}</option> 
                            @endforeach
                        </select>
                        @foreach ($displayproperty as $row)
                        <input class="form-control" autocomplete="off" type="text" name="edittempname" id="edittempname" value="{{$row->tempname}}" placeholder="Assigned Employee Name">
                        @endforeach
                    </div>  
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="Description">
                    <strong>Property Number:</strong>
                        @foreach ($displayproperty as $row)
                        <textarea class="form-control" autocomplete="off" type="text" name="editdescription" id="editdescription" placeholder="Description" required>{{$row->description}}</textarea>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                     <strong>Date Acquired:</strong>
                        @foreach ($displayproperty as $row)
                        <input class="form-control" autocomplete="off" type="date" name="editdate_acquired" id="editdate_acquired" value="{{$row->date_acquired}}" required>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Property Number:</strong>
                        @foreach ($displayproperty as $row)
                        <input class="form-control" autocomplete="off" type="text" name="editpropertynumber" id="editpropertynumber" placeholder="Property Number" value="{{$row->propertynumber}}" required>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Unit Value:</strong>
                        @foreach ($displayproperty as $row)
                        <input class="form-control" autocomplete="off" type="number" name="editunitofmeasure" id="editunitofmeasure" placeholder="Unit of Measure" value="{{$row->unitmeasure}}" required>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Quantity:</strong>
                        @foreach ($displayproperty as $row)
                        <input class="form-control" autocomplete="off" type="number" name="editunitvalue" id="editunitvalue" placeholder="Unit Value" value="{{$row->value}}" required>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Received Date:</strong>
                        @foreach ($displayproperty as $row)
                        <input class="form-control" autocomplete="off" type="date" name="editreceived_date" id="editreceived_date" placeholder="Unit Value" value="{{$row->received_date}}">
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Status:</strong>
                        <select class="form-control" name="editstatusid" id="editstatusid" style="width:100%" required>
                            <option value=''>Status of Equipment</option> 
                            <option value='SERVICIABLE'>SERVICIABLE</option> 
                            <option value='UNSERVICIABLE'>UNSERVICIABLE</option> 
                            <option value='WASTE'>WASTE</option> 
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>Remarks:</strong>
                        @foreach ($displayproperty as $row)
                        <textarea class="form-control" autocomplete="off" type="text" name="editremarks" id="editremarks" placeholder="Remarks">{{$row->remarks}}</textarea>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" id="ssubmit" class="btn btn-success">Submit</button>
                </div>
             </div>
            </form>
            </div>
          </div>
        </div>
    </div>
</div>
<script>
    $("#edittempname").hide();
    $("#editassignedto").next().hide();
    $("#editarticleid").select2();
    $("#editassignedto").select2();
    $("#editassignedto").next().hide();

        var test = $("#editregistered").val();
                if(test=="YES"){
                    $("#editassignedto").next().show();  
                    $("#edittempname").hide();
                }
                else if (test=="NO"){
                    $("#editassignedto").next().hide();
                    $("#edittempname").show();
                }
                else{
                    $("#edittempname").hide();
                    $("#editassignedto").next().hide();  
                }
   //$("#editregistered").select2();
            //$("#editregistered").change(function () {
                $("#editregistered").bind("click", function () {
                var reg = this.value;
                if(reg=="YES"){
                    $("#editassignedto").next().show();  
                    $("#edittempname").hide();
                    $('#edittempname').val("");
                }
                else if (reg=="NO"){
                    $("#editassignedto").next().hide();
                    $("#edittempname").show();
                    $("#editassignedto")[0].selectedIndex ="";
                }
                else{
                    $("#edittempname").hide();
                    $("#editassignedto").next().hide();  
                }
            });

            $(function() {
                $('#editinventory').submit(function(e) {
                    e.preventDefault();
                    var test = $("#editregistered").val();
                    var editassignedto = $('#editassignedto').val();
                    var edittempname = $('#edittempname').val();
                    if(test=="YES"){
                        if (editassignedto.length < 1) {
                        $('#edittempname').after('<span style="color:red">This field is required</span>');
                        }
                        else{
                            e.currentTarget.submit();
                        }
                    }
                    else if (test=="NO"){
                        if (edittempname.length < 1) {
                        $('#edittempname').after('<span style="color:red">This field is required</span>');
                        }
                        else{
                            e.currentTarget.submit();
                        }
                    } 

                });
            });
</script>
@endsection
