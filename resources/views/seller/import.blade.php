@extends('layouts.global')

@section('title')
    Import Product
@endsection

@section('content')
    <div class="card">
        <h4 class="mb-3">Import Excel</h4>
        <div class="card-body">
            <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Upload File <code class="text-muted">.csv</code></label>
                    <input type="file" class="form-control" name="files">
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>
@endsection