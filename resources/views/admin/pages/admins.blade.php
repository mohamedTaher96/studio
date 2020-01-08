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
    </style>
@endsection
@section('content')
@if (session('add'))
    <div class='alert alert-success'><strong></strong>  تم إضافة المشرف بنجاح. </div>
@endif
@if (session('delete'))
    <div class='alert alert-success'><strong></strong>  تم حذف المشرف بنجاح. </div>
@endif
@if (session('noDelte'))
    <div class='alert alert-danger'><strong></strong>  لا يمكن حذف هذا المشرف . </div>
@endif
@if (session('edit'))
    <div class='alert alert-success'><strong></strong>  تم تعديل المشرف بنجاح. </div>
@endif
@if (session('noEdit'))
    <div class='alert alert-danger'><strong></strong>  لا يمكن تعديل هذا المشرف . </div>
@endif
<section class="content-header">
        <h1>
          المشرفون
        <small> </small>
        </h1>
        <br>
        <a  role="button"  class="lang btn btn-primary" href="admins/new"> إضافة مشرف</a>
</section>
<section class="">
        <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                        <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                        <th>  الاسم</th>
                                        <th> البريد الالكتروني</th>
                                        <th>  الصفحة</th>
                                        <th> تعديل/مسح</th>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody">
                                        @foreach ($admins as $item)
                                            <tr>
                                                <td>{{$item->first_name}} {{$item->last_name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td><a href="admins/profile?id={{$item->id}}">عرض</a></td>
                                                <td>
                                                    @if ($item->id!='9')
                                                    <a role="button" class="btn btn-primary" href="admins/delete?id={{$item->id}}" onclick='return confirm("are you sure you want to delete {{$item->first_name}} {{$item->last_name}}")'> مسح</a>
                                                    <a role="button" class="btn btn-primary" href="admins/edit?id={{$item->id}}"> تعديل</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                  <tfoot>
                                    <tr>
                                        <th> البريد الالكتروني</th>
                                        <th> تعديل/مسح</th>
                                    </tr>
                                  </tfoot>
                                </table>
                              </div>
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