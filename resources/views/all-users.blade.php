@extends("layouts.app")
@section("content")
    @include('nav_bar')
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
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td><a href="{{url('admin/edit-users/'. $user->id)}}">Edit</a></td>
                    <td><a href="{{url('admin/edit-users/'. $user->id)}}">Delete</a></td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    {{$users->links()}}
@endsection
