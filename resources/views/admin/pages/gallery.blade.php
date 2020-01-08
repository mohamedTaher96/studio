@extends('admin/layout/adminLayout')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/admin/dataTables.bootstrap.css')}}">
    <style>
        td
        {
            word-break: break-word;
        }
        .form-control
        {
            padding: 0px 12px;
        }
        img
        {
            width: 50px;
            height: 50px;
        }
    </style>
@endsection
@section('content')
@if (session('add'))
    <div class='alert alert-success'><strong></strong>  تم إضافة التصنيف بنجاح. </div>
@endif
@if (session('delete'))
    <div class='alert alert-success'><strong></strong>  تم حذف التصنيف بنجاح. </div>
@endif
@if (session('edit'))
    <div class='alert alert-success'><strong></strong>  تم تعديل التصنيف بنجاح. </div>
@endif
<section class="content-header">
        <h1>
        تعديل معرض الصور
        <small> </small>
        </h1>
        <br>
</section>
<section class="">
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">  التصنيفات  </h3>
                  <a href="galery/new/" role="button" class="btn btn-primary" >إضافة تصنيف</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th> اسم التصنيف</th>
                        <th> غلاف التصنيف</th>
                        <th>عدد الصور</th>
                        <th>وقت الانشاء</th>
                        <th> تعديل/مسح</th>
                      </tr>
                    </thead>
                    <tbody>
                        {!!$categories!!}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th> اسم التصنيف</th>
                            <th> غلاف التصنيف</th>
                            <th>عدد الصور</th>
                            <th>وقت الانشاء</th>
                            <th> تعديل/مسح</th>
                        </tr>
                    </tfoot>
                  </table>
                </div>
        </div>
</section>

@endsection
@section('script')
        <!-- DataTables -->
        <script src="{{asset('js/admin/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('js/admin/dataTables.bootstrap.min.js')}}"></script>
        <script>
            $("#example1").DataTable();
            if($(".alert"))
            {
                window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 1000);
            }
        </script>
@endsection