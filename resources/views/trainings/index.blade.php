@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Training List') }}</div>

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
                                        <a href="{{ route('training:show', $training) }}" class="btn btn-primary">Show</a>
                                        <hr>
                                        <a href="{{ route('training:edit', $training) }}" class="btn btn-success">Edit</a>
                                        <hr>
                                        <a
                                            onclick="return confirm('Are you sure want to delete?')"
                                            href="{{ route('training:delete', $training) }}"
                                            class="btn btn-danger"
                                        >
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <td>No data</td>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $trainings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
