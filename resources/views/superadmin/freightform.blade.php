@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <div class="ibox">


                <div class="card p-4">
                    <form action="{{ route('freight.import.excel') }}" method="POST" enctype="multipart/form-data"
                        class="d-inline">
                        @csrf

                        <input type="file" name="file" id="freightExcel" hidden required>

                        <button type="button" class="btn btn-primary me-3"
                            onclick="document.getElementById('freightExcel').click()">
                            ↑ Import Excel
                        </button>

                        <button type="submit" class="btn btn-success">
                            Upload
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
