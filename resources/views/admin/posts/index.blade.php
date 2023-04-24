@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-success" href="{{ route("admin.$table.create") }}">
                        Create
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Remotable</th>
                            <th>Is Part-time</th>
                            <th>Range Salary</th>
                            <th>Date Range</th>
                            <th>Status</th>
                            <th>Is Pinned</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function (){
       $.ajax({
           url: '{{ route('api.posts') }}',
           dataType: 'json',
           {{--data: {page: {{ request()->get('page') ?? 1 }}},--}}
           success: function(response) {
               response.data.forEach(function (each) {
                   let location = each.district + ' - ' + each.city;
                   let remotable = each.remotable ? 'x' : '';
                   let is_partime = each.can_parttime ? 'x' : '';
                   let range_salary = (each.min_salary && each.max_salary) ? each.min_salary + '-' + each.max_salary : '';
                   let range_date = (each.start_date && each.end_date) ? each.start_date + '-' + each.end_date : '';
                   let is_pinned = each.is_pinned ? 'x' : '';
                   $('#table-data').append($('<tr>')
                       .append($('<td>').append(each.id))
                       .append($('<td>').append(each.job_title))
                       .append($('<td>').append(location))
                       .append($('<td>').append(remotable))
                       .append($('<td>').append(is_partime))
                       .append($('<td>').append(range_salary))
                       .append($('<td>').append(range_date))
                       .append($('<td>').append(each.status))
                       .append($('<td>').append(is_pinned))
                       .append($('<td>').append(each.created_at))
                   );
               });
           },
           error: function(response){
               $.toast({
                   heading: 'Import Error',
                   text: response.responseJSON.message,
                   showHideTransition: 'slide',
                   position: 'bottom-right',
                   icon: 'error'
               })
           }
       })
    });
</script>
@endpush
