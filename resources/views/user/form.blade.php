@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">

        <div class="page-content fade-in-up">

            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Basic Validation</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('user.store') }}" method="POST" class="form-horizontal" id="form-sample-1"
                        novalidate="novalidate">
                        @csrf
                        @php
                            $fieldValue = old('question', $model->question ?? '');
                        @endphp
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name of Inspection :</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name of Inspector</label>
                            <div class="col-sm-10">
                                <input type="text" name="Inspector" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Station</label>
                            <div class="col-sm-10">
                                <input type="text" name="author" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Type of Inspection</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Duration</label>
                            <div class="col-sm-10">
                                <input type="text" name="category" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="page-content fade-in-up">

            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Basic Validation</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NFR Revenue Excel</label>
                            <div class="col-sm-10">
                                <input type="file" name="revenue_file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Records Excel</label>
                            <div class="col-sm-10">
                                <input type="file" name="records_file" class="form-control">
                            </div>
                        </div>
                           <div class="form-group row">
                            <label class="col-sm-2 col-form-label">OUTWARD FREIGHT REGISTER Excel</label>
                            <div class="col-sm-10">
                                <input type="file" name="fright_file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
@endsection
