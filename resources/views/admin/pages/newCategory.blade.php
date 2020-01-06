@extends('admin/layout/adminLayout')
@section('content')
    @if (session('error'))
    <div class='alert alert-danger '><strong></strong>    اسم التصنيف مطلوب ونوع الملف يجب ان يكون صوره </div>
    @endif
    <section class="content-header">
            <h1>
            إضافة تصنيف
            <small> </small>
            </h1>
    </section>
    <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h2 class="box-title">تصنيف جديد  </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="add" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> اسم التصنيف</label>
                          <input type="text" class="form-control" name="name" placeholder=" ">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">غلاف التصنيف  </label>
                          <input type="file"  name="logo">
                        </div>
                      </div><!-- /.box-body -->
    
                      <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-primary">إضافة</button>
                      </div>
                    </form>
                  </div>
    </section>        
    @section('script')
        <script>

        </script>

    @endsection
@endsection