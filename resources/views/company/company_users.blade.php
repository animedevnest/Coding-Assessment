@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-title">
        <h5>Add Users to Company {{ $company->name }}</h5>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-sm-12">
                
                @forelse ($users as $user)
                    <input type="checkbox" name="users[]" id="user-{{ $user->id }}"  value="{{ $user->id }}" @if(in_array($user->id,$company_user)) checked @endif>  {{ $user->name }} <br>
                @empty
                <tr>
                    <td colspan="4">No Data Available</td>
                </tr>
                @endforelse
                <button type="button" id="save" class="btn btn-success">Save</button>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#save').on('click',function ()
        {
            var userID = [];
            $(':checkbox:checked').each(function(i){
                userID[i] = $(this).val();
            });

            $.ajax({
                url:'{{ url("company/add/users")}}',
                type:"POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    'id' : "{{ $company->id }}",
                    'user':userID,
                },
                success:function(data)
                {
                    // console.log(data);
                    swal(data['message']);
                    setTimeout(() => {
                        window.location.href= "{{ url('company') }}";
                    }, 2000);
                },
                error: function(request, status, error) {
                json = $.parseJSON(request.responseText);
                $.each(json.errors, function(key, value) {
                    var error_key = value;
                    console.log(error_key);
                    swal(error_key);
                });
                }
            });
        });

</script>
@endpush