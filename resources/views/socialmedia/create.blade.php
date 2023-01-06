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

        <form action="{{ route('socialmedia.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">{{ __('socialmedia.platform_name') }}</label>
                            <input type="text" name="platform_name"  value="{{ old('platform_name') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="account_url">{{ __('socialmedia.account_url') }}</label>
                            <input type="text" name="account_url"  value="{{ old('account_url') }}" class="form-control">
                        </div>
                    </div>
                </div>



                <div class="row pt-3">

                    <div class="col-12">
                        <div class="form-group">
                            <label for="status">{{ __('general.status') }}</label>
                            <select name="status" id="" class="select2Fe form-control">
                                <option value="1">{{ __('general.active') }}</option>
                                <option value="0">{{ __('general.deactivate') }}</option>
                            </select>
                        </div>
                    </div>





        </div>
            <button type="submit" class="btn btn-primary me-2 mt-3">Submit</button>
            <a href="{{ url()->previous() }}" class="btn btn-light mt-3">Cancel</a>
        </form>
      </div>

    </div>
  </div>
</div>
</div>
@endsection
