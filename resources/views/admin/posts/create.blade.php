@extends('layout.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.posts.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control" name="company" id="select-company"></select>
                        </div>
                        <div class="form-group">
                            <label>Language</label>
                            <select class="form-control" multiple name="language" id="select-language"></select>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <select class="form-control" name="company" id="select-city"></select>
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <select class="form-control" name="company" id="select-district"></select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Min Salary</label>
                                <input type="number" name="min_salary" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label>Max Salary</label>
                                <input type="number" name="max_salary" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label>Max Salary</label>
                                <select name="currency_salary" class="form-control">
                                    @foreach($currencies as $currency => $value)
                                        <option value="{{ $value }}">
                                            {{ $currency }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Requirement</label>
                            <textarea name="requirement" class="form-control" cols="40"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label>Past time</label>
                                <br>
                                <input type="checkbox" name="can_parttime" id="can_parttime" checked data-switch="info" class="mt-2">
                                <label for="can_parttime" data-on-label="Yes" data-off-label="No"></label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-4">
                                <label>Number Applicant</label>
                                <input type="number" name="number_applicant" class="form-control">
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-4">
                                <label>Title</label>
                                <input type="text" name="job_title" class="form-control" id="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success ">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        async function loadDistrict() {
            // $('#select-city').empty();
            const path = $("#select-city option:selected").data('path');
            const response = await fetch('{{ asset('location/') }}' + path);
            const districts = await response.json();
            $.each(districts.district, function(index, each) {
                console.log(each);
                if(each.pre === 'Quận' ){
                    $("#select-district").append(`
                        <option>
                            ${each.name}
                        </option>`)
                }
            })
        }
        $(document).ready( async function($) {
            const response = await fetch('{{ asset('location/index.js') }}');
            const cities = await response.json();
            $.each(cities, async function(index, each) {
                // console.log(each);
                $("#select-city").append(`<option value='${each.code}' data-path='${each.file_path}'> ${index} </option>`)
            })
            $("#select-city").change(function() {
                loadDistrict();
            })
            $('#select-district').select2({tags: true});
            loadDistrict();
            $("#select-company").select2({
                tags: true,
                ajax: {
                    url: '{{ route('api.companies') }}',
                    data: function (params) {
                        var queryParameters = {
                            q: params.term
                        }

                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            })
                        };
                    },

                }
            });
            $("#select-language").select2({
                ajax: {
                    url: '{{ route('api.languages') }}',
                    data: function (params) {
                        var queryParameters = {
                            q: params.term
                        }

                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            })
                        };
                    },
                }
            });
        });
    </script>
@endpush
