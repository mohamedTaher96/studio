@extends('admin/layout/adminLayout')
@section('style')
    <style>
        .form-control
        {
            padding: 0px 12px;
        }
    </style>
@endsection
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">الملف يجب ان يكون صوره</div>
    @endif
    <section class="content-header">
            <h1>
            إضافة صورة
            <small> </small>
            </h1>
    </section>
    <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h2 class="box-title">صورة جديد  </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="new/add" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> اسم التصنيف</label>
                            <select class="form-control" name="category">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile"> الصورة  </label>
                          <input type="file"  name="images[]" multiple>
                        </div>
                      </div><!-- /.box-body -->
    
                      <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-primary">إضافة</button>
                        <img id="img" class="hide" src="{{asset('images/ajax-loader.gif')}}">
                      </div>
                    </form>
                  </div>
    </section>        
    @section('script')
        <script>
            $("#submit").click(function(){
                $("#img").removeClass("hide");
                $(this).addClass("hide");
            })
        </script>
    @endsection
@endsection