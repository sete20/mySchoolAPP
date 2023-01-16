@extends('layouts.app')
@section('title')
{{ trans('lesson.sub_unit_page_title') }}
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

        <form action="{{ route('subUnit.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
                <div class="row pt-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">{{ __('lesson.title') }}</label>
                            <input type="text" name="title"  value="{{ $subUnit->title }}" class="form-control">
                        </div>
                    </div>

                </div>


                <div class="row pt-3">
                        <div class="col-6">
                            <div class="form-group">
                           <label for="parent_unit">{{ __('lesson.parent_unit') }}</label>
                            <select name="unit_id" id="" class="select2Fe form-control">
                                @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" @if($subUnit->unit_id ==$unit->id ) selected @endif>{{ $unit->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">{{ __('general.status') }}</label>
                            <select name="status" id="" class="select2Fe form-control">
                                <option value="1" @if($subUnit->status == 1  ) selected @endif>{{ __('general.type_active') }}</option>
                                <option value="0"  @if($subUnit->status == 0  ) selected @endif >{{ __('general.type_deactive') }}</option>
                            </select>
                        </div>
                    </div>
                          <div class="col-12">
                        <div class="form-group">
                            <label for="description">{{ __('lesson.description') }}</label>
                                <textarea class="form-control"
                                          id="description" name="description"
                                          placeholder="Enter description ..">{{ $subUnit->description }}</textarea>
                                 <script>
                                    CKEDITOR.replace('description');
                                </script>
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
