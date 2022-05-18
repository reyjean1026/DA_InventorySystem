<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/assets/img/daicon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/assets/img/daicon.png')}}">
  <title>
    Inventory Management System
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('assets/plugins/select2.min.css')}}" rel="stylesheet" /> 
  <link href="{{asset('assets/plugins/jquery.dataTables.min.css')}}" rel="stylesheet" />

  <script src="{{asset('assets/plugins/3.5.1.jquery.min.js')}}"></script> 
  <script type="text/javascript" src="{{asset('assets/plugins/1.9.1.jquery.min.js')}}"></script>
  <script src="{{asset('assets/plugins/jquery.dataTables.min.js')}}" crossorigin="anonymous"></script>
  <script src="{{asset('assets/plugins/select2.min.js')}}"></script>

</head>
    <style>
            @media print
            {    
                .no-print, .no-print *
                {
                    display: none !important;
                }
                body {
                    margin: 0;
                    color: #000;
                    background-color: #fff;
                    padding-top:25mm;
                }
                .pagebreak { page-break-before: always; }
            }
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 90%;
            margin: auto;
            table-layout: fixed;
            }

            td, th {
            /*border: 1px solid black;*/
            text-align: left;
            padding: 8px;
            font-size: 15px;
            word-wrap:break-word;
            }
            th{
                /*text-align: center;*/
            }

           
    </style>
    <body>  
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
                                <button class="no-print" onClick="window.print()">Print</button>
                                <a class="btn btn-primary no-print" href="{{ route('acquired.index') }}"> Back</a>
                            <div class="card">
                                <div class="card-header pb-0">
                                    <center>
                                        <p class="mb-0"><b>Summary of Report on Physical Count of Property, Plant and Equipment
                                            <br>as of <?php $today = date("M d,Y"); echo $today; ?></b></p>
                                    </center>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <table id="tblsrpcppe" class="display" style="width:90%">
                                                    <thead>
                                                        <tr>
                                                            <th class="">ACCOUNT TITLE</th>
                                                            <th style="text-align:right" class="">TOTAL</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($calculatesrpcppe as $row)
                                                        <tr>
                                                            <td class="">{{$row->category_name}}</td>
                                                            <td style="text-align:right" class="">Php{{number_format($row->Total, 2, '.', ',') }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th class="">Grand Total</th>
                                                            <th style="text-align:right" class="">Php<?php
                                                            $sum = 0.00;
                                                            foreach($calculatesrpcppe as $value)
                                                            {
                                                                (float)$sum+= (float)$value->Total;
                                                            }
                                                            echo number_format($sum, 2, '.', ',');
                                                            ?>
                                                            </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <center><p>WE HEREBY CERTIFY THAT Physical Inventory of properties, plant and equipment was conducted and found true and correct. <br> Statement composed of Regional Office and its Stations of the Department of Agriculture- Caraga, Butuan City</p></center>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <table class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="33%" class=""><center>ARIEL DOMINIC S. ARIAS</center></th>
                                                            <th width="33%" class=""><center>GEZELLE JOY A. BAJAO</center></th>
                                                            <th width="33%" class=""><center>JULIETA M. GAYRAMA</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class=""><center>Member</center></td>
                                                            <td class=""><center>Member</center></td>
                                                            <td class=""><center>Member</center></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <table class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="33%" class=""><center>LUZ V. FURIA</center></th>
                                                            <th width="33%" class=""><center>JOSEPHINE A. MAZO</center></th>
                                                            <th width="33%" class=""><center>CORAZON A. YAMIT</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class=""><center>Member</center></td>
                                                            <td class=""><center>Member</center></td>
                                                            <td class=""><center>Chairman, Inventory Committee</center></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <table class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="50%" class=""><center>Approved by:</center></th>
                                                            <th width="50%" class=""><center>Verified by:</center></th>
                                                        </tr>
                                                        <tr>
                                                            <th width="50%" class=""><center></center></th>
                                                            <th width="50%" class=""><center></center></th>
                                                        </tr>
                                                        <tr>
                                                            <th width="50%" class=""><center>ENGR. RICARDO M. ONATE. JR.</center></th>
                                                            <th width="50%" class=""><center>JESUS MISAEL D. ALMENDRALEJO</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class=""><center>Regional Executive Director</center></td>
                                                            <td class=""><center>State Auditor IV</center></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            </div>  
                        </div>
                        <br>
                    </div>
            </div>
            <br>
            </div>
        </div>
           <!--   Core JS Files     -->
  <script src="{{asset('assets/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>

<script src="{{asset('assets/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/assets/js/plugins/chartjs.min.js')}}"></script>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc     -->
    </body>  
</html>  