@php use App\Enums\UserRoleEnum; @endphp
@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form  class="form-horizontal" id="form-filter">
                        <div class="form-group">
                            <label for="Role">Role</label>
                            <div class="col-3">
                                <select class="form-control select-filter" name="role" id="role">
                                    <option selected>All</option>
                                    @foreach($roles as $role => $value)
                                        <option value="{{ $value }}" @if((string)$value === $selectedRole) selected @endif>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
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
                            <th>Company Name</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $each)
                            <tr>
                                <td>
                                    <a href="">
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
                                    {{ optional($each->company)->name }}
                                </td>
                                <td>
                                    <form action="{{ route("admin.$table.destroy", $each)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            Xóa
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
