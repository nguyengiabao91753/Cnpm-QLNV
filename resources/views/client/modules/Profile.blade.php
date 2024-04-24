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

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <img src="{{ asset('uploads/' . $emp->image) }}" class="card-img-top" alt="...">
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
<h1>Salary</h1>
<div class="card">
    <div class="card-header">
        <div class="form-inline">
            <label for="month-select">Month:</label>
            <select class="form-control" style="width: 10%;" id="month-select">
                <option value="">Tất cả</option>
                <option value="1">Tháng 1</option>
                <option value="2">Tháng 2</option>
                
            </select>
            <label for="year-select" style="padding-left: 15px;">Year:</label>
            <select class="form-control" style="width: 10%;" id="year-select">
                <option value="">Tất cả</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                ...
            </select>
        </div>
    </div>
    <div class="card-body">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Hệ số lương</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Lương cơ bản: <span id="base-salary"></span></li>
                    <li class="list-group-item">Hệ số lương: <span id="factor"></span></li>
                    <li class="list-group-item">Hệ số phụ cấp: <span id="allowance-factor"></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Lương tháng <span id="selected-month"></span></h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Lương nhận được: <span id="salary-gain"></span></li>
                    <li class="list-group-item">Số ngày đi trễ: <span id="late-days"></span></li>
                    <li class="list-group-item">Số ngày vắng: <span id="absent-days"></span></li>
                    <li class="list-group-item">Số ngày tăng ca: <span id="overtime-days"></span></li>
                    <li class="list-group-item">Tổng lương: <span id="total"></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection