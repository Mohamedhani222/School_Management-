@extends('layouts.master')
@section('css')
    @section('title')
        {{trans('main_trans.list_students')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.list_students')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <button type="button" class="btn btn-danger mb-2" data-toggle="modal"
                                        data-target="#Delete_all">
                                    تراجع عن كل الترقيات
                                </button>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="alert-info">{{trans('Students_trans.name')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.from_grade')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.from_class')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.from_section')}}</th>
                                            <th>{{trans('Students_trans.to_grade')}}</th>
                                            <th>{{trans('Students_trans.to_class')}}</th>
                                            <th>{{trans('Students_trans.to_section')}}</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->f_grade->Name}}</td>
                                                <td>{{$promotion->f_class->Name_class}}</td>
                                                <td>{{$promotion->f_section->Name_section}}</td>
                                                <td>{{$promotion->t_grade->Name}}</td>
                                                <td>{{$promotion->t_class->Name_class}}</td>
                                                <td>{{$promotion->t_section->Name_section}}</td>

                                                <td>

                                                    <button type="button" class="btn btn-outline-danger"
                                                            data-toggle="modal"
                                                            data-target="#Delete_one{{$promotion->id}}">ارجاع الطالب
                                                    </button>
                                                    <button type="button" class="btn btn-outline-success"
                                                            data-toggle="modal" data-target="#">تخرج الطالب
                                                    </button>

                                                </td>


                                            </tr>
                                        @include('pages.students.promotions.Delete_all')
                                        @include('pages.Students.promotions.Delete_one')

                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
@endsection
