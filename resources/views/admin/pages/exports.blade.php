@extends('admin/layout/adminLayout')
@section('style')
    <style>
        td
        {
            word-break: break-word;
            padding: 20px;
        }
    </style>
@endsection
@section('content')
@if (session('delete'))
<div class='alert alert-success'><strong></strong>  تم مسح الرساله بنجاح. </div>
@endif
<div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            البريد 
            <small>13 رسالة جديدة </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="https://studio-20.herokuapp.com/admin"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
            <li class="active">البريد</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">الملفات</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="https://studio-20.herokuapp.com/admin/messages/"><i class="fa fa-inbox"></i> الوارد <span class="label label-primary pull-right">{{$unread}}</span></a></li>
                    <li><a href="https://studio-20.herokuapp.com/admin/messages/exports"><i class="fa fa-envelope-o"></i> الصادر</a></li>
                    <li><a id="deleteExportMessages" href="#" ><i class="fa fa-trash-o"></i> مسح</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">الصادر</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Mail">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                            @foreach ($exports as $export)
                            <tr>
                                <td><input class="check" id="{{$export->id}}" type="checkbox"></td>
                                <td class="mailbox-name"><a href="export?id={{$export->id}}">{{$export->company_name}}</a></td>
                                <td >{{$export->email}}</td>
                                <td>{{ Carbon\Carbon::parse($export->created_at)->diffForHumans()}}</td>
                            </tr>    
                            @endforeach

                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
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
      $("#deleteExportMessages").click(function(){
        if(confirm("are you sure you want to delete messages?"))
        {
          var deleteArray = new Array();
        $(".check").each(function()
        {
          if($(this).prop('checked'))
          {
            deleteArray.push($(this).attr("id"));
          }
        })
        if(deleteArray.length>0)
        {
          $.ajax({
          url:"deleteExportMessages",
          type:"GET",
          headers:
		      {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data:{deleteArray:deleteArray},
          success:function(data)
          {
            location.reload();
          }
        })
        }else
        {
          alert("لا توجد رسائل محدده");
        }
        }
      })
    </script>
@endsection