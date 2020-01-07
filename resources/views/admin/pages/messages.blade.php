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
                    <li><a href="exports"><i class="fa fa-envelope-o"></i> الصادر</a></li>
                    <li><a id="deleteMessages" href="#" ><i class="fa fa-trash-o"></i> مسح</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">الوارد</h3>
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
                            @foreach ($messages as $message)
                            <tr>
                                <td><input class="check" id="{{$message->id}}" type="checkbox"></td>
                                <td class="mailbox-name"><a href="order?id={{$message->id}}">{{$message->company_name}}</a></td>
                                <td >{{$message->email}}</td>
                                <td>{{ Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</td>
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
      $("#deleteMessages").click(function(){
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
          url:"deleteMessages",
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
      // $(function () {
      //   //Enable iCheck plugin for checkboxes
      //   //iCheck for checkbox and radio inputs
      //   $('.mailbox-messages input[type="checkbox"]').iCheck({
      //     checkboxClass: 'icheckbox_flat-blue',
      //     radioClass: 'iradio_flat-blue'
      //   });

      //   //Enable check and uncheck all functionality
      //   $(".checkbox-toggle").click(function () {
      //     var clicks = $(this).data('clicks');
      //     if (clicks) {
      //       //Uncheck all checkboxes
      //       $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
      //       $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      //     } else {
      //       //Check all checkboxes
      //       $(".mailbox-messages input[type='checkbox']").iCheck("check");
      //       $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      //     }
      //     $(this).data("clicks", !clicks);
      //   });

      //   //Handle starring for glyphicon and font awesome
      //   $(".mailbox-star").click(function (e) {
      //     e.preventDefault();
      //     //detect type
      //     var $this = $(this).find("a > i");
      //     var glyph = $this.hasClass("glyphicon");
      //     var fa = $this.hasClass("fa");

      //     //Switch states
      //     if (glyph) {
      //       $this.toggleClass("glyphicon-star");
      //       $this.toggleClass("glyphicon-star-empty");
      //     }

      //     if (fa) {
      //       $this.toggleClass("fa-star");
      //       $this.toggleClass("fa-star-o");
      //     }
      //   });
      // });
    </script>
@endsection