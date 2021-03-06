@extends('admin/layout/adminLayout')
@section('content')
    @if (session('error'))
    <div class='alert alert-danger'>اسم التصنيف مطلوب ونوع الملف يجب ان يكون صوره</div>
    @endif
    <section class="content-header">
            <h1>
            تعديل تصنيف
            <small> </small>
            </h1>
    </section>
    <section class="content">

            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h2 class="box-title">تصنيف الحالي  </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="new" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> اسم التصنيف</label>
                        <input type="hidden" name="id" value="{{$category->id}}">
                        <input type="text" value="{{$category->name}}" class="form-control" name="name" placeholder=" ">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">غلاف التصنيف  </label>
                          <input type="file"  name="logo">
                        </div>
                      </div><!-- /.box-body -->
    
                      <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-primary">تعديل</button>
                      </div>
                    </form>
                  </div>
    </section>        
    @section('script')
        <script>

        </script>
    @endsection
@endsection