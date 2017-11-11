@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Requests</h3>
                </div>

                <div class="panel-body">
                   Users
                </div>

                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Price</th>
                        <th>Price</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                        <td>Product A</td>
                        <td>200</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection