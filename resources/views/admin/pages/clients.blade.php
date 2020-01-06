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
    <div class='alert alert-success'><strong></strong>  تم إضافة العميل بنجاح. </div>
@endif
@if (session('delete'))
    <div class='alert alert-success'><strong></strong>  تم حذف العميل بنجاح. </div>
@endif
@if (session('edit'))
    <div class='alert alert-success'><strong></strong>  تم تعديل العميل بنجاح. </div>
@endif
<section class="content-header">
        <h1>
        تعديل العملاء
        <small> </small>
        </h1>
        <br>
</section>
<section class="">
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">  العملاء  </h3>
                  <a href="new/" role="button" class="btn btn-primary" >إضافة عميل</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th> اسم الشركه</th>
                        <th>بريد الشركه</th>
                        <th>صورة الشركه</th>
                        <th>وقت الشراكه</th>
                        <th> تعديل/مسح</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                          
                        <tr>
                            <td>{{$client->client_name}}</td>
                            <td>{{$client->client_email}}</td>
                            <td><a target="_blank" rel="noopener noreferrer"  href="{{asset('images/clients/'.$client->client_logo."")}}"><img src="{{asset('images/clients/'.$client->client_logo)}}" ></a></td>
                            <td>{{$client->created_at}}</td>
                        <td><a role="button" class="btn btn-primary" href="edit?id={{$client->id}}">تعديل</a >
                            <a role="button" class="btn btn-primary" onclick="return confirm('are you sure you want to delete this client : {{$client->client_name}}')" href="delete?id={{$client->id}}&name={{$client->client_logo}}">مسح</a>
                     </td>
                        </tr>
                    @endforeach  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th> اسم الشركه</th>
                        <th>بريد الشركه</th>
                        <th>صورة الشركه</th>
                        <th>وقت الشراكه</th>
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