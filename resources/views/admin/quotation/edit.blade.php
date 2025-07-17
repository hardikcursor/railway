@extends('layouts.backend')

@section('main')
<div class="content-wrapper">
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Edit Quations ({{ ucfirst($model) }})</div>
            </div>

            <div class="ibox-body">
                <form action="{{ route('admin.quotation.update', ['model' => $model, 'id' => $quotation->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="checks">Quations Text</label>
                        <input type="text"
                               class="form-control @error('checks') is-invalid @enderror"
                               name="checks"
                               value="{{ old('checks', $quotation->checks ?? $quotation->items ?? $quotation->Particulars) }}">
                        @error('checks')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update Quotation</button>
                    <a href="{{ route('admin.quotationshow') }}" class="btn btn-secondary mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
