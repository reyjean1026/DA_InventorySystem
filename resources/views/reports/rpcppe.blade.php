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
        @page {
  margin: 1in;
}

@page :first {
  margin-top: 2in;
}

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
                    /*padding-top:15mm;*/
                  
                }
                .pagebreak { 
                    page-break-before: always; 
                    padding-top:15mm;
                }
                
               
            }
          
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 90%;
            margin: auto;
            table-layout: fixed;
            }

            td, th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
            font-size: 11px;
            word-wrap:break-word;
            }
            th{
                text-align: center;
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
                        @foreach ($maincategory as $row)
                        <div class="card">
                            <div class="card-header pb-0">
                                <center>
                                    <p class="mb-0">
                                        <b>REPORT ON PHYSICAL COUNT OF PROPERTY PLANT AND EQUIPMENT 
                                        <br> DA-CARAGA 
                                        <br>{{$row->category_name}} ({{$row->code}})
                                        </b>
                                        <br>as of <?php $today = date("M d,Y"); echo $today; ?></p>
                                </center>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <table>
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" width="12%">ARTICLE</th>
                                                        <th rowspan="2" width="25%">DESCRIPTION</th>
                                                        <th rowspan="2" width="5%">DATE ACQUIRED</th>
                                                        <th rowspan="2" width="5%">PROPERTY NUMBER</th>
                                                        <th rowspan="2" width="5%">UNIT OF MEASURE</th>
                                                        <th rowspan="2" width="5%">UNIT VALUE</th>
                                                        <th rowspan="2" width="8%">TOTAL VALUE</th>
                                                        <th colspan="2" width="8%">SHORTAGE/OVERAGE</th>
                                                        <th rowspan="2" width="7%">STATUS</th>
                                                        <th rowspan="2" width="8%">ASSIGNED</th>
                                                        <th rowspan="2" width="12%">REMARKS</th>
                                                    </tr>
                                                    <tr>
                                                        <th width="4%">QTY</th>
                                                        <th width="4%">Value</th>  
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($subcategory as $row1)
                                                            @if ( $row1->catid === $row->id)
                                                        <tr>
                                                            <td>{{$row1->article}}</td>
                                                            <td>{{$row1->description}}</td>
                                                            <td>{{$row1->date_acquired}}</td>
                                                            <td>{{$row1->property_number}}</td>
                                                            <td>{{$row1->quantity}}</td>
                                                            <td style="text-align:right;">{{number_format($row1->unitvalue, 2, '.', ',') }}</td>
                                                            <td style="text-align:right;">
                                                            <?php
                                                            $quantity = $row1->quantity;
                                                            $unitvalue = $row1->unitvalue;
                                                            $sum = 0;
                                                            (float)$sum+= (float)$quantity*(float)$unitvalue ;
                                                            echo number_format($sum, 2, '.', ',');
                                                            ?>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>{{$row1->status}}</td>
                                                            <td>{{$row1->fullname}}{{$row1->temp_name}}</td>
                                                            <td>{{$row1->remarks}}</td>
                                                        </tr>
                                                            @endif
                                                        @endforeach  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        @endforeach
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