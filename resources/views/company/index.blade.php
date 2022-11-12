@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <h1>Comapany List</h1>
        <div>
            <a href="{{route('company.create')}}" class="btn btn-dark ml-3">Add Company</a>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-sm-12">
                <table id="company" class="table nowrap" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Add Users</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                            @forelse ($companies as $key => $company)
                                    <tr>
                                        <td>{{$company->name}}</td>
                                        <td><a href='{{ url("company/".$company->id."/users") }}' class="btn-sm btn-info">Add Users</a></td>
                                        <td><a href='{{ url("company/".$company->id."/edit") }}' class="btn-sm btn-warning">Edit</a></td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="companyDelete('{{$company->id}}')" class="btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                            @empty
                            <tr>
                                <td colspan="4">No Data Available</td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    // datatable
    $(document).ready(function () {
        var table = $('#company').DataTable({
            responsive: true
        });
    });
    function companyDelete(id)
        {
            $.ajax({
                url:'{{ url("company/destroy")}}',
                type:"DELETE",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    'id':id,
                },
                success:function(data)
                {
                    console.log(data);
                    swal(data['message']);
                    // setTimeout(() => {
                    //     location.reload();
                    // }, 2000);
                },
                error: function(request, status, error) {

                spinner.hide();

                $('.error').empty();
                json = $.parseJSON(request.responseText);
                $.each(json.errors, function(key, value) {
                    var error_key = value;
                    console.log(error_key);
                    swal(error_key);
                });
                }
            });
        }

</script>
@endpush