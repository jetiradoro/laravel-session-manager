@extends('session-manager::layout')
@section('content')
    <div id="sm-app">
        <div v-cloak class="container ">
            <div style="margin-bottom: 15px">
                <button class="btn btn-primary" @click="load"> <i class="fa fa-refresh"></i> </button>
            </div>
            <table class="table table-sm table-condensed table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="session in users">
                    <td>@{{session.user.id}}</td>
                    <td>@{{ session.user.name }}</td>
                    <td>@{{ session.user.email }}</td>
                    <td><button @click="remove(session)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        window.sm_config = {!! json_encode(config('session-manager')) !!};
    </script>
@endsection
