@extends('admin/layout/adminLayout')
@section('style')
    
@endsection
@section('content')
        @if (session('access'))
            <div class='alert alert-danger'><strong></strong>   الدخول غير مسموح </div>
        @endif
        <section class="content-header">
                <h1>
                الرئيسيه
                <small> </small>
                </h1>
        </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @if(Session::has('الصفحات'))
          <div class="col-lg-3 col-sm-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <p> تعديل  الصفحات</p>
                  <hr>
                </div>
                <div class="icon">
                  <i class=""></i>
                </div>
                <a href="admin/editPages/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
          @endif
          @if (Session::has('الرزم والخيارات'))
          <div class="col-lg-3 col-sm-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <p>  الأوردر </p>
                  <hr>
                  <div class="container">
                      <h6>
                          <sup style="font-size: 14px">عددالرزم : {{$packageNo}}</sup><br><br>
                      </h6>
                  </div>
                </div>
                <div class="icon">
                  <i class="   "></i>
                </div>
                <a href="https://studio-20.herokuapp.com/admin/orders/packages/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
          @endif
          @if (Session::has('الصور والتصنيفات'))
          <div class="col-lg-3 col-sm-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <p> معرض الصور </p>
                  <hr>
                  <div class="container">
                      <h6>
                          <sup style="font-size: 14px">عددالتصنيفات : {{$categoryNo}}</sup><br><br>
                          <sup style="font-size: 14px">عددالصور : {{$imageNo}}</sup>
                      </h6>
                  </div>
  
                </div>
                <div class="icon">
                  <i class=""></i>
                </div>
                <a href="https://studio-20.herokuapp.com/admin/gallery/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
          @endif
          @if (Session::has('المشرفون') |Session::has('العملاء')|Session::has('المشتركون'))
              <div class="col-lg-3 col-sm-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3></h3>
                      <p>  أخري</p>
                      <hr>
                      <div class="container">
                          <h6>
                              @if (Session::has('المشرفون'))
                                <sup style="font-size: 14px">عددالمشرفون : {{$adminsNo}}</sup><br><br>
                              @endif
                              @if (Session::has('العملاء'))
                                <sup style="font-size: 14px">عددالعملاء : {{$clientNo}}</sup><br><br>
                              @endif
                              @if (Session::has('المشتركون'))
                                <sup style="font-size: 14px">عددالمشتركون : {{$subscriberNo}}</sup>
                              @endif
                          </h6>
                      </div>
                    </div>
                    <div class="icon">
                      <i class=""></i>
                    </div>
                    <a href="admin/other/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                  </div>
                </div><!-- ./col -->
          @endif
        </div><!-- /.row -->
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