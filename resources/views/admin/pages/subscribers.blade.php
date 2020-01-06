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
    <div class='alert alert-success'><strong></strong>  تم إضافة المشترك بنجاح. </div>
@endif
@if (session('delete'))
    <div class='alert alert-success'><strong></strong>  تم حذف المشترك بنجاح. </div>
@endif
<section class="content-header">
        <h1>
          المشتركون
        <small> </small>
        </h1>
        <br>
        <a  role="button"  class="lang btn btn-primary" href="sendMessage"> إرسال رسالة</a>
        <a  role="button"  class="lang btn btn-primary" href="new"> إضافة مشترك</a>
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
                                      <th> البريد الالكتروني</th>
                                      <th> مسح</th>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody">
                                        @foreach ($subscribers as $subscriber)
                                            <tr>
                                                <td>{{$subscriber->email}}</td>
                                                <td><a role="button" class="btn btn-primary" href="delete?id={{$subscriber->id}}"> مسح</a></td>
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
                  {{-- <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>  البريد الإلكتروني</th>
                        <th>  مسح</th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($subscribers as $subscriber)
                            <tr>
                                <td>{{$subscriber->email}}</td>
                                <td><a role="button" class="btn btn-primary" href="delete?id={{$subscriber->id}}"> delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table> --}}
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