@extends('admin.master')

@section('module', 'Statitical')
@section('action', 'System')
@section('sta', 'menu-open')
@section('sta-info', 'active')
@push('css')

<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('administrator/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('administrator/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{ asset('administrator/plugins/jqvmap/jqvmap.min.csss')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('administrator/dist/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('administrator/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('administrator/plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('administrator/plugins/summernote/summernote-bs4.min.css')}}">
<link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-responsive/css/responsive.bootstrap4.min.css ') }}">
<link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-buttons/css/buttons.bootstrap4.min.css ') }}">

@endpush


@push('js')
<script src="{{ asset('administrator/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('administrator/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- ChartJS -->
<script src="{{ asset('administrator/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->

<!-- overlayScrollbars -->
<script src="{{ asset('administrator/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<script src="{{ asset('administrator/dist/js/pages/dashboard3.js')}}"></script>
<script>
  $(document).ready(function() {
    if ($('#date_sa').val() == 0) {
      var today = new Date();
      var dayOfMonth = today.getDate();

      if (dayOfMonth === 16) {
        $('.calc-salary').show();
      }
    }
  })

  $(document).ready(function() {
    $('#example1_filter').show();

        $('#depselect').change(function() {
          var value = $(this).val();
          $('#searchtable').val(value).focus();
          //alert(value);
          // $.ajax({
          //   url: '/getattbydep',
          //   type: 'get',
          //   data: {
          //     depId: value
          //   },
          //   dataType: 'json',
          //   success: function(response) {
          //     $('#example1 tbody').empty();
          //     alert(response['data'][0].work.employee);
          //     // Duyệt qua mỗi phần tử trong response['data']
          //     $.each(response['data'], function(index) {
          //         var att = response['data'][index];

          //         // Tạo một hàng mới và thêm các dữ liệu từ response vào
          //         var newRow = '<tr>' +
          //           //'<td>' + att.work.employee.name + '</td>' +
          //           '<td>' + att.work.employee.position.department.name + '</td>' +
          //           '<td>' + att.work.shift.start + ' - ' + att.work.shift.end + '</td>' +
          //           '<td>' + att.work.room.name + '</td>' +
          //           '<td>' + att.clock_in + ' - ' + att.clock_out + '</td>' +
          //           '<td>' + att.description + '</td>' +
          //           '</tr>';

          //         // Thêm hàng mới vào tbody của bảng
          //         $('#example1 tbody').html(newRow);
                
          //     });
          //   }
          // });
        });
      });
        //
</script>
@endpush

@push('hanldejs')
<script>
  $(function() {
    $("#example1, #example2").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush



@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v3</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$countemp}}</h3>

            <p>Employees</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{route('admin.employee.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$countdep}}</h3>

            <p>Departments</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">Coming soon <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$countroom}}</h3>

            <p>Patient rooms</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">Coming soon <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$countpos}}</h3>

            <p>Positions</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">Coming soon <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row calc-salary" style="display: none;">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Calculate This month's salary</h3>

            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <input type="text" name="" id="date_sa" value="{{isset($empsa_date->id) ? $empsa_date->id : 0 }}" hidden>
              <a href="{{route('admin.calc')}}" class="btn btn-info">Calc</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Employee Attendance Today</h3>
          </div>
          <div class="card-header border-0">
            <select id="depselect" name="department" class="form-control " style="width: 20%;">
              <option value="">All Department</option>
              @foreach ($deps as $dep )
              <option value="{{$dep->id}}">
                {{$dep->name}}
              </option>
              @endforeach
            </select>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Shift</th>
                  <th>Room</th>
                  <th>Clock-in/Clock-out</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($atts as $att )
                <tr>
                  <td>
                    {{$att->work->employee->name}}
                  </td>
                  <td>
                    {{$att->work->employee->position->department->name}}
                  </td>
                  <td>
                    {{$att->work->shift->start}} - {{$att->work->shift->end}}
                  </td>
                  <td>
                    {{$att->work->room->name}}
                  </td>
                  <td>
                    {{$att->clock_in}} - {{$att->clock_out}}
                  </td>
                  <td>
                    {{$att->description}}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>


      </div>

    </div>

  </div>
  <!-- /.container-fluid -->
</div>

@endsection