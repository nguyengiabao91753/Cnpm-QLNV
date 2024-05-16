@extends('client.client')

@section('module', 'Employee')
@section('action', 'Information')
@section('profile', 'menu-open')
@push('css')
<style>
    .card {
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .list-group-item {
        border-color: #ddd;
    }

    .card-title {
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }

    .contact-info li,
    .experience li,
    .education li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .contact-info b,
    .experience h5,
    .education h5 {
        color: #333;
    }

    .list-group-item {
        border-color: #ddd;
        margin: 5px 0;
        /* Đặt margin top và bottom */
        padding: 10px;
    }

    .list-group-item {
        border-color: #ddd;
        margin: 5px 0;
        padding: 10px;
    }
</style>
@endpush

@push('hanldejs')
<script>
    $(document).ready(function() {


        $('#sal_go').click(function() {
            var month = $('#month-select').val();
            var year = $('#year-select').val();
            $('#base-salary').empty();
            $('#factor').empty();
            $('#allowance-factor').empty();
            $('#salary-gain').empty();
            $('#late-days').empty();
            $('#absent-days').empty();
            $('#overtime-days').empty();
            $('#leave-early').empty();
            $('#total').empty();
            $.ajax({
                url: '/showsal',
                type: 'get',
                data: {
                    sal_month: month,
                    sal_year: year
                },
                dataType: 'json',
                success: function(response) {
                    //alert(response.late);

                    $('#base-salary').append(response.base);
                    $('#factor').append(response.factor);
                    $('#allowance-factor').append(response.allowance_factor);

                    $('#salary-gain').append(response.salary);
                    $('#late-days').append(response.late);
                    $('#absent-days').append(response.abs);
                    $('#overtime-days').append(response.overtime);
                    $('#leave-early').append(response.leave_early);

                    $('#total').append(response.total);

                }
            })
        });
    });
</script>
@endpush

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <img src="{{ asset('uploads/' . $emp->image) }}" class="card-img-top" style="height: 380px;" alt="">
            <div class="card-body">
                <h3 class="card-title">Fullname: {{$emp->name}}</h3>
                <p class="card-text">Position: {{$emp->position->name}}</p>
                <p class="card-text">Department: {{$emp->position->department->name}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><b>Contact Information: </b></h5>
                <ul class="list-group list-group-flush contact-info">
                    <li class="list-group-item">Email: {{$emp->email}}</li>
                    <li class="list-group-item">Phone number: {{$emp->phone}}</li>
                    <!-- <li class="list-group-item">Địa chỉ: ...</li> -->
                </ul>
                <br>

                @php
                use Illuminate\Support\Carbon;
                $createdAt = Carbon::parse($emp->created_at);

                // Lấy năm hiện tại
                $current = Carbon::now();

                // Tính sự khác biệt trong năm
                $differenceY = $current->year - $createdAt->year;

                $differenceInMonths = $current->diffInMonths($createdAt);
                $months = $differenceInMonths % 12;
                @endphp
                <h5 class="card-title"><b>Work Experience:</b></h5>
                <ul class="list-group list-group-flush experience">
                    <li class="list-group-item">Year: {{ $differenceY}}</li>
                    <li class="list-group-item">Month: {{$months}}</li>
                </ul>
                <br>
                <!-- <h5 class="card-title"><b>Giáo dục và đào tạo</b></h5>
                <ul class="list-group list-group-flush education">
                    <li class="list-group-item">2014 - 2018: Đại học Y ...</li>
                    <li class="list-group-item">2010 - 2014: Trường THPT ...</li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
@php
$work_day = DB::table('work__schedules')->where('emp_id', Auth::guard('client')->id() )->get();
$atts = DB::table('attendances')->whereIn('work_id', $work_day->pluck('id'))->get();
$abs = 0;
$late = 0;
$leave_early = 0;
$overtime = 0;
    foreach ($atts as $att) {
        if ($att->leave_approved == 0 && $att->present == 0) {
            $abs += 1;
        } else {
                if (strpos($att->description, 'Late') !== false) {
                $late += 1;
                }
                if (strpos($att->description, 'early')) {
                $leave_early += 1;
                }
                if (strpos($att->description, 'Overtime')) {
                $overtime += 1;
                }
        }
    }
@endphp
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar-check"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Work day</span>
                <span class="info-box-number">
                    {{count($atts) - $abs}}
                    <!-- <small>%</small> -->
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hourglass-half"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Late</span>
                <span class="info-box-number">{{$late}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clock"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Overtime</span>
                <span class="info-box-number">{{$overtime}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar-times"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Day-Off</span>
                <span class="info-box-number">{{$abs}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<h1>Salary</h1>
<div class="card">
    <div class="card-header">
        <div class="form-inline">
            <label for="month-select">Month:</label>
            <select class="form-control" style="width: 10%;" id="month-select">
                <option value="">Select Month</option>
                @foreach ($sal_months as $sal_month )
                <option value="{{$sal_month->month}}">{{$sal_month->month -1}}</option>
                @endforeach
                <!-- <option value="1">Tháng 1</option>
                <option value="2">Tháng 2</option> -->

            </select>
            <label for="year-select" style="padding-left: 15px;">Year:</label>
            <select class="form-control" style="width: 10%;" id="year-select">
                <option value="">Select Year</option>
                @foreach ($sal_years as $sal_year )
                <option value="{{$sal_year->year}}">{{$sal_year->year}}</option>
                @endforeach
                ...
            </select>

            <button type="button" class="btn btn-info form-control" id="sal_go" style="margin-left: 15px;"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="card-body">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Salary Information</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Base: <span id="base-salary" style="float: right;"></span></li>
                    <li class="list-group-item">Factor: <span id="factor" style="float: right;"></span></li>
                    <li class="list-group-item">Allowance-factor: <span id="allowance-factor" style="float: right;"></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Salary Gain <span id="selected-month"></span></h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Salary: <span id="salary-gain" style="color: greenyellow; font-size: large;font-weight: bold; float: right;"></span></li>
                    <li class="list-group-item">Late-days: <span id="late-days" style="color: red; font-size: large;font-weight: bold;float: right;"></span></li>
                    <li class="list-group-item">leave-early: <span id="leave-early" style="color: red; font-size: large;font-weight: bold;float: right;"></span></li>
                    <li class="list-group-item">Absent-days: <span id="absent-days" style="color: red; font-size: large;font-weight: bold;float: right;"></span></li>
                    <li class="list-group-item">Overtime-days: <span id="overtime-days" style="color: greenyellow; font-size: large;font-weight: bold;float: right;"></span></li>
                    <li class="list-group-item">Total: <span id="total" style="color: greenyellow; font-size: large;font-weight: bold;"></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection