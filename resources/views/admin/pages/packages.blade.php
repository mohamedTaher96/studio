@extends('admin/layout/adminLayout')
@section('style')
    <style>
        td
        {
            padding: 12px;
        }
    </style>
@endsection
@section('content')
    @if (session('edit'))
    <div class='alert alert-success'><strong></strong>  تم تعديل الرزمه بنجاح. </div>
    @endif
    @if (session('delete'))
    <div class='alert alert-success'><strong></strong>  تم مسح الرزمه بنجاح. </div>
    @endif
    @if (session('add'))
    <div class='alert alert-success'><strong></strong>  تم إضافة الرزمه بنجاح. </div>
    @endif
    <section class="content-header">
        <h1>
        تعديل الرزم 
        <small> </small>
        </h1>
        <br>
        <a href="packages/new" class="btn btn-primary">إضافة رزمه</a>
    </section>
    <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">  الرزم  </h2><br><br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم الرزمه</th>
                                <th> النص الانجليزي</th>
                                <th>   الخيارات</th>                                
                                <th>  تعديل/مسح</th>
                            </tr>

                         </thead>
                        <tbody id="tbody">
                            @foreach ($packages as $package)
                                <tr>
                                    <td>{{$package->name}}</td>
                                    <td>{{$package->enName}}</td>
                                    <td><a href="oprions?id={{$package->id}}">الخيارات </a></td>
                                    <td>
                                        <a role="button" class="btn btn-primary" href="edit?id={{$package->id}}">تعديل</a>
                                        <a role="button" class="btn btn-primary" href="delete?id={{$package->id}}">مسح</a>
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection
@section('script')
        <script>
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