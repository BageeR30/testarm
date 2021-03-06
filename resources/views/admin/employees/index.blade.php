@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Сотрудники</div>

                    <div class="panel-body table-responsive">

                        <router-view name="employeesIndex"></router-view>
                        <router-view></router-view>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
