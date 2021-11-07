@extends('layouts.app')

@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">MartinNetwork</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Felhasználók</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Felhasználók</h6>
    </nav>
    <script>
        document.getElementById('userspage').classList.add('bg-primary')
    </script>
@endsection

@section('content')
    <div class="container">
        <h1>User list - Active User</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Photo</th>
                <th>Away</th>
            </tr>
            @foreach($onlineUsers as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['image'] }}</td>
                    <td>{{ $user['away'] }}</td>
                </tr>
            @endforeach
            <tr>
        </table>

    </div>
@endsection
