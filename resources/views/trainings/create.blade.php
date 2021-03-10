@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Training Module</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Training Create</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Training Create Form') }}</div>

                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" cols="20" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Attachment</label>
                            <input type="file" class="form-control" name="attachment">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Store My Training</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
