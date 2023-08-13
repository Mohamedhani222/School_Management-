@extends('layouts.master')
@section('css')
    @section('title')
        اضافة فاتورة جديدة
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        اضافة فاتورة جديدة {{$student->name}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class=" row mb-30" action="{{ route('invoices.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Fees">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">اسم الطالب</label>
                                                <select class="custom-select mr-sm-2 " name="student_id" required>
                                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="fee_id" class="mr-sm-2">نوع الرسوم</label>
                                                <div class="box">
                                                    <select class="custom-select mr-sm-2 " name="fee_id" id="fee_id" required>
                                                        <option value="">-- اختار من القائمة --</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="amount_id" class="mr-sm-2">المبلغ</label>
                                                <div class="box">
                                                    <select class="custom-select mr-sm-2 " name="amount_id" id="amount_id" >
                                                        <option value="">-- اختار من القائمة --</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="description" class="mr-sm-2">البيان</label>
                                                <div class="box">
                                                    <input type="text" class="form-control " name="description" required>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="Name_en"
                                                       class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                       type="button"
                                                       value="{{ trans('My_Classes_trans.delete_row') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                               value="{{ trans('My_Classes_trans.add_row') }}"/>
                                    </div>
                                </div>
                                <br>
                                <input type="hidden" name="Grade_id" value="{{$student->Grade_id}}">
                                <input type="hidden" name="Classroom_id" value="{{$student->Classroom_id}}">

                                <button type="submit" class="btn btn-primary">تاكيد البيانات</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#fee_id').on('change', function () {--}}
{{--                var fee_id = $(this).val();--}}
{{--                console.log(fee_id);--}}
{{--                if (fee_id) {--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ URL::to('Get_amounts') }}/" + fee_id,--}}
{{--                        type: 'GET',--}}
{{--                        datatype: 'json',--}}
{{--                        success: function (data) {--}}
{{--                            $.each(data, function (key, value) {--}}
{{--                                $('#amount_id').empty();--}}
{{--                                $('#amount_id').append('<option value="' + key + '">' + key + '</option>');--}}
{{--                            });--}}
{{--                        }--}}
{{--                    });--}}
{{--                } else {--}}
{{--                    console.log('error ajax')--}}
{{--                }--}}

{{--            });--}}
{{--        });--}}

{{--    </script>--}}

@endsection
