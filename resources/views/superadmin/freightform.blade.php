@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <div class="container">
                <h3>Freight Excel Import</h3>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('freight.import') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <input type="file" name="file" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">
                        Import Excel
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection
