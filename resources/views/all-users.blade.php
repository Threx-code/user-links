@extends("layouts.app")
@section("content")
    @include('nav_bar')
    <p class="alert alert-info result" style="margin-left: 0px; margin-top: -3px; display: none;"></p>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Username</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Date Created</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($users))
            @foreach($users as $key => $user)
                <tr class="userrow{{$user->id}}">
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td><a href="{{url('admin/edit-users/'. $user->id)}}">Edit</a></td>
                    <td>
                        <form method="post" class="delete{{$user->id}}" action="{{ route('admin.delete')}}">
                            @csrf
                            <input type="hidden" name="user_id"  value="{{$user->id}}" >
                            <input type="submit" class="submit{{$user->id}}" value="Delete">
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                $(".delete{{$user->id}}").on("submit", (function(e){
                                    e.preventDefault();
                                    $(".submitLoader").show();
                                    $.ajaxSetup({
                                        headers:{
                                            "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                                        }
                                    });

                                    $.ajax({
                                        url:"{{ route('admin.delete')}}",
                                        method:'POST',
                                        data:new FormData(this),
                                        contentType:false,
                                        processData:false,
                                        success:function(data){
                                            if(data == "User deleted"){
                                                $('.userrow{{$user->id}}').hide();
                                            }
                                            $('.result').html(data);
                                        },
                                        error:function(xhr){
                                            var data = xhr.responseJSON;

                                            if($.isEmptyObject(data.errors) == false){
                                                $.each(data.errors, function(key, result){
                                                    $('.result').html(result);
                                                });
                                            }
                                        }
                                    })
                                }))
                            })

                        </script>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    {{$users->links()}}
@endsection
