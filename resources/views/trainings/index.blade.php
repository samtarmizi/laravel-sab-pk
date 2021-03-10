@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('alert'))
                <div class="alert {{ session()->get('alert-type') }}" role="alert">
                    {{ session()->get('alert') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    {{ __('My Training List') }}
                    <div class="float-right">
                        <form action="" method="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" value="{{ request()->get('keyword') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Creator</th>
                                <th>Created At<th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trainings as $training)
                                <tr>
                                    <td>{{ $training->id }}</td>
                                    <td>{{ $training->title }}</td>
                                    <td>{{ $training->user->name }}</td>
                                    <td>{{ $training->created_at }}</td>
                                    <td>
                                        @can('view', $training)
                                            <a href="{{ route('training:show', $training) }}" class="btn btn-primary">Show</a>
                                            <hr>
                                        @endcan
                                        @can('update', $training)
                                            <a href="{{ route('training:edit', $training) }}" class="btn btn-success">Edit</a>
                                            <hr>
                                        @endcan
                                        @can('delete', $training)
                                        <a
                                            onclick="return confirm('Are you sure want to delete?')"
                                            href="{{ route('training:delete', $training) }}"
                                            class="btn btn-danger"
                                        >
                                            Delete
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <td>No data</td>
                            @endforelse
                        </tbody>
                    </table>
                    {{ 
                        $trainings->appends([
                            'keyword' => request()->get('keyword')
                        ])->links() 
                    }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
