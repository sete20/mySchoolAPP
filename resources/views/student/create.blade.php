@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row pt-3">
<div class="col grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger" role="alert"> {{__("global.error")}}
            @foreach ($errors->all() as $error )
                <li>{{$error}}</li>
            @endforeach
        </div>

        @endif
        @if (Session::has('success'))
        <p class="alert alert-success">{{__('global.success') }}</p>
        @endif
        <h4 class="card-title">{{ __('user.create') }}</h4>

        <form action="{{ route('dashboard.user.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">{{ __('user.name') }}</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">{{ __('user.email') }}</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">{{ __('user.phone') }}</label>
                            <input type="tel" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="type">{{ __('user.type') }}</label>
                            <select name="type" id="" class="select2Fe form-control">
                                   <option value="indevisioual">{{ __('user.type_indevisioual') }}</option>
                                   <option value="company">{{ __('user.type_company') }}</option>
                                </select>
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">{{ __('user.image') }}</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">{{ __('general.status') }}</label>
                            <select name="status" id="" class="select2Fe form-control">
                                <option value="1">{{ __('general.active') }}</option>
                                <option value="0">{{ __('general.deactivate') }}</option>
                            </select>
                        </div>
                    </div>


                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password">{{ __('user.password') }}</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('user.password_confirmation') }}</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                </div>


        </div>
            <button type="submit" class="btn btn-primary me-2 mt-3">Submit</button>
            <button class="btn btn-light mt-3">Cancel</button>
        </form>
      </div>

    </div>
  </div>
</div>
</div>
@endsection
