@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <h1>User List</h1>
        <div>
            <a href="{{route('user.create')}}" class="btn btn-dark ml-3">Add User</a>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-sm-12">
                <table id="users" class="table nowrap" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><a href='{{ url("user/".$user->id."/edit") }}' class="btn-sm btn-warning">Edit</a></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="userDelete('{{$user->id}}')" class="btn-sm btn-danger">Delete</a>
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
        var table = $('#users').DataTable({
            responsive: true
        });
    });
    function userDelete(id)
        {
            $.ajax({
                url:'{{ url("user/destroy")}}',
                type:"DELETE",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    'id':id,
                },
                success:function(data)
                {
                    // console.log(data);
                    swal(data['message']);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
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