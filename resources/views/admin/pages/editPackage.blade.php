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
    <section class="content-header">
            <h1>
            تعديل الرزمه
            <small> </small>
            </h1>
    </section>
    <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h2 class="box-title">الرزمه الحاليه   </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="update" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> اسم الرزمه</label>
                            <input type="text" class="form-control" name="arPackage" value="{{$package->name}}" ><br>
                            <label for="exampleInputEmail1">  النص الإنجليزي</label>
                            <input type="text" class="form-control" name="enPackage" value="{{$package->enName}}" >    
                            <input type="hidden" name="id" value="{{$package->id}}">                 
                        </div>
                      </div>
    
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