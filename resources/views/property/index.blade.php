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
                <div class="row">
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
                                    <table id="tblinventory" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th hidden></th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category Name</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article Name</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Acquired</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit of Measure</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Value</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Available</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($displayinventory as $row)
                                            <tr>
                                                <td hidden>{{$row->id}}</td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->type}}</td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->status}}</td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->categoryname}}</td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->article}}</td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->description}}</td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->date_acquired}}</td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">Php{{number_format($row->unit_of_measure, 2, '.', ',') }}</td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{$row->unitvalue}}</td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">
                                                <?php
                                                $unitofmeasure = $row->unit_of_measure;
                                                $unitvalue = $row->unitvalue;
                                                $total = $unitofmeasure*$unitvalue;
                                                ?>
                                                  Php{{number_format($total, 2, '.', ',') }}
                                                </td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center"></td>
                                                <td class="text-secondary text-xs font-weight-bold align-middle text-center">
                                                    <button id="inputDatabaseName" class="badge badge-sm bg-gradient-primary btnSelect">add</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th hidden></th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category Name</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article Name</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Acquired</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit of Measure</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Value</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Available</th>
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
                <div class="row">
                         <p></p>
                </div>
                <div class="row">           
                    <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0"><b>ADD PROPERTY</b></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/storeproperty" method="POST" enctype="multipart/form-data">
                            @csrf
                                <table id="mytable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Article</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Acquired</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit of Measure</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle text-center" hidden>
                                                <input type="text" id="colidinventory" name="colidinventory" class="text-secondary text-xs font-weight-bold align-middle text-center">
                                            </td>
                                            <td class="align-middle text-center">
                                                <span id="coltype" class="text-secondary text-xs font-weight-bold align-middle text-center"></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span id="colstatus" class="text-secondary text-xs font-weight-bold align-middle text-center"></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span id="colcategory" class="text-secondary text-xs font-weight-bold align-middle text-center"></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span id="colarticle" class="text-secondary text-xs font-weight-bold align-middle text-center"></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span id="coldesc" class="text-secondary text-xs font-weight-bold align-middle text-center"></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span id="coldateacquired" class="text-secondary text-xs font-weight-bold align-middle text-center"></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span id="colunitofmeasure" class="text-secondary text-xs font-weight-bold align-middle text-center"></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span id="colunitvalue" class="text-secondary text-xs font-weight-bold align-middle text-center"></span>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                                <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                             <div id="serialnumber">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                             <div id="propertynumber">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                             <div id="daterequired">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                             <div id="remarks">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                             <button class="btn btn-success btn-sm ms-auto">Add Property</button>
                                        </div>
                                    </div>
                                </div>
                           
                           <!--
                            <form action="/storeinventory" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" name="articleid" id="articleid" style="width:100%">
                                                    <option value=''>Select Article</option> 
                                                    <option value=''></option> 
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="form-control" autocomplete="off" type="number" name="unitvalue" id="unitvalue" placeholder="Unit Value">  
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <select class="form-control" name="status" id="status">
                                                    <option value=''>Select Status</option> 
                                                    <option value='Equipment'>EQUIPMENT</option> 
                                                    <option value='Supply'>SUPPLY</option> 
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
                            -->
                            </form>
                        </div>
                    </div>
                 </div>
                </div>  
            </div>  
    </div>

    <script>
        $(document).ready(function() {
            $('#tblinventory').DataTable();
            $("#inventory_id").removeAttr("enabled"); 
            $("#tblinventory").on('click','.btnSelect',function(){
                //alert("sadasdasd");
                var currentRow=$(this).closest("tr"); 
                var total = currentRow.find("td:eq(8)").text();
                var serialrawhtml = "";
                var propertyrawhtml = "";
                var daterequiredrawhtml = "";
                var remarksrawhtml = "";

                //table add property
                var txtcolidinventory = currentRow.find("td:eq(0)").text();
                var txtcoltype = currentRow.find("td:eq(1)").text();
                var txtcolstatus = currentRow.find("td:eq(2)").text();
                var txtcolcategory = currentRow.find("td:eq(3)").text();
                var txtcolarticle = currentRow.find("td:eq(4)").text();
                var txtcoldesc = currentRow.find("td:eq(5)").text();
                var txtcoldateacquired = currentRow.find("td:eq(6)").text();
                var txtcolunitofmeasure = currentRow.find("td:eq(7)").text();
                var txtcolunitvalue = currentRow.find("td:eq(8)").text();



                for (var i = 1; i <= total; i++) {
                   
                    serialrawhtml += " <input type='text' class='form-control' autocomplete='off' id='txtbox" + i + "' name='txtserialdata[]' placeholder='Serial Number'><br/>";
                    propertyrawhtml += " <input type='text' class='form-control' autocomplete='off' id='txtbox1" + i + "' name='txtpropertydata[]' placeholder='Property Number'><br/>";
                    daterequiredrawhtml += " <input type='date' class='form-control' autocomplete='off' id='txtbox2" + i + "' name='txtdaterequiredata[]' placeholder='Date'><br/>";
                    remarksrawhtml += " <input type='text' class='form-control' autocomplete='off' id='txtbox3" + i + "' name='txtremarksdata[]' placeholder='Remarks'><br/>";
                    //$('#divAnswers').show();
                    /*$("#ddlAnswers").change(function () {
                        var noOfAnswers = $("#ddlAnswers").val();
                        var rawhtml1 = "";
                        for (var j = 1; j <= noOfAnswers; j++) {
                            rawhtml1 += "Ans" + j + "<textarea id='txtAnswer" + j + "' class = 'txtans' wrap = 'hard'/><br/>";
                        }
                        $("#allanswer").html(rawhtml1);
                    });*/
                }
                $("#colidinventory").val(txtcolidinventory);
                $("#colstatus").html(txtcolstatus);
                $("#colcategory").html(txtcolcategory);
                $("#colarticle").html(txtcolarticle);
                $("#coldesc").html(txtcoldesc);
                $("#coldateacquired").html(txtcoldateacquired);
                $("#colunitofmeasure").html(txtcolunitofmeasure);
                $("#colunitvalue").html(txtcolunitvalue);
                $("#coltype").html(txtcoltype);

                $("#serialnumber").html(serialrawhtml);
                $("#propertynumber").html(propertyrawhtml);
                $("#daterequired").html(daterequiredrawhtml);
                $("#remarks").html(remarksrawhtml);
            });

           /* $("#tblinventory").on('click','.btnSelect',function(){
                // get the current row
                var currentRow=$(this).closest("tr"); 
                
                var col1=currentRow.find("td:eq(6)").text(); // get current row 1st TD value
                var data=col1
                
                alert(data);
            });*/
        } );
    </script>
    @endsection