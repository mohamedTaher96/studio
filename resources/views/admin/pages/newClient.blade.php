@extends('admin/layout/adminLayout')
@section('content')
    @if (session('error'))
    <div class='alert alert-danger'> جميع البيانات مطلوبه ونوع الملف يجب ان يكون صوره</div>
    @endif
    <section class="content-header">
            <h1>
            إضافة عميل
            <small> </small>
            </h1>
    </section>
    <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h2 class="box-title">عميل جديد  </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="new/add" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> اسم العميل</label>
                          <input type="text" class="form-control" name="name" placeholder=" ">
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1"> بريد العميل</label>
                                <input type="email" class="form-control" name="email" placeholder=" ">
                              </div>
                        <div class="form-group">
                          <label for="exampleInputFile">شعار العميل  </label>
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