@extends('layouts.app')
@section('title')
{{ trans('user.socialmedia_page_title') }}
@endsection
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

        <form action="{{ route('assistant.update',$socialmedia) }}" enctype="multipart/form-data" method="POST">
            @method('put')
            @csrf
          <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">{{ __('user.platform_name') }}</label>
                            <input type="text" name="platform_name"  value="{{ $socialmedia->platform_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="account_url">{{ __('user.account_url') }}</label>
                            <input type="text" name="account_url"  value="{{ $socialmedia->account_url }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row pt-3">

                    <div class="col-12">
                        <div class="form-group">
                            <label for="status">{{ __('general.status') }}</label>
                            <select name="status" id="" class="select2Fe form-control">
                                <option value="1"@if($socialmedia->status == 1) checked @endif>{{ __('general.active') }}</option>
                                <option value="0"@if($socialmedia->status == 0) checked @endif>{{ __('general.deactivate') }}</option>
                            </select>
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
