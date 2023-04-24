@php use App\Enums\UserRoleEnum; @endphp
@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-success" href="{{ route("admin.managements.create") }}">
                        Create
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Info</th>
                            <th>Role</th>
                            <th>Position</th>
                            <th>City</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $each)
                            <tr>
                                <td>
                                    <a>
                                        {{ $each->id }}
                                    </a>
                                </td>
                                <td>{{ $each->name }} </td>
                                <td>
                                    {{ $each->name }} - {{ $each->gender_name }}
                                    <br>
                                    <a href="mailto: {{ $each->email }}">
                                        {{ $each->email }}
                                    </a>
                                    <br>
                                    <a href="tel: {{ $each->email }}">
                                        {{ $each->phone }}
                                    </a>
                                </td>
                                <td>
                                    {{ UserRoleEnum::getKeys( $each->role )[0] }}
                                </td>
                                <td>
                                    {{ $each->position }}
                                </td>
                                <td>
                                    {{ $each->city }}
                                </td>
                                <td>
                                    <a href="{{ route("admin.$table.edit", $each)}}" class="action-icon float-right"> <i class="mdi mdi-pencil"></i></a>
                                    <form action="{{ route("admin.$table.destroy", $each)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-icon border-0">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                    <nav>
                        <ul class="pagination pagination-rounded mb-0">
                            {{ $data->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(".select-filter").change(function() {
                $("#form-filter").submit();
            });
        });
    </script>
@endpush
