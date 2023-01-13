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
        <h4 class="card-title">{{ __('subscription.create') }}</h4>

        <form action="{{ route('subscription.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="row pt-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">{{ __('unit.title') }}</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">{{ __('unit.price') }}</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">{{ __('unit.status') }}</label>
                            <select name="status" id="" class="select2Fe form-control">
                                   <option value="1">{{ __('unit.active') }}</option>
                                   <option value="0">{{ __('unit.deactive') }}</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="duration">{{ __('unit.duration_months') }}</label>
                              <input class="form-control" type="number" name="duration" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="duration">{{ __('unit.units') }}</label>
                            <select name="units_id[]" class="select2Fe form-control" multiple>
                                @foreach ($units as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">{{ __('unit.description') }}</label>
                                <textarea class="form-control"
                                          id="description" name="description"
                                          placeholder="Enter description .."></textarea>
                                 <script>
                                    CKEDITOR.replace('description');
                                </script>
                        </div>
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
