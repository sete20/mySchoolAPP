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
        <h4 class="card-title">{{ __('lesson.create') }}</h4>

        <form action="{{ route('lesson.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="row pt-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">{{ __('lesson.title') }}</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                        <label for="parent_unit">{{ __('lesson.sub_unit') }}</label>
                            <select name="sub_unit_id" id="" class="select2Fe form-control">
                                @foreach ($sub_units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">{{ __('lesson.status') }}</label>
                            <select name="status" id="" class="select2Fe form-control">
                                   <option value="1">{{ __('lesson.active') }}</option>
                                   <option value="0">{{ __('lesson.deactive') }}</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">{{ __('lesson.description') }}</label>
                                <textarea class="form-control"
                                          id="description" name="description"
                                          placeholder="Enter description .."></textarea>
                                 <script>
                                    CKEDITOR.replace('description');
                                </script>
                        </div>
                    </div>

                </div>

                    <div class="row pt-3">
                                <div class="col-6">
                        <div class="form-group">
                        <label for="attachments">{{ __('lesson.attachments') }}</label>
                        <input type="file" class="form-control" name="attachments[]" multiple >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                                <label for="attachments">{{ __('lesson.video') }}</label>
                                <input type="file"class="form-control"  name="video">
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