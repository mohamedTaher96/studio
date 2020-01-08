@extends('admin/layout/adminLayout')
@section('content')
        <section class="content-header">
                <h1>
                أخري
                <small> </small>
                </h1>
        </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @if (Session::has('المشرفون'))
          <div class="col-lg-3 col-sm-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3></h3>
                  <p>  المشرفون</p>
                </div>
                <div class="icon">
                  <i class=""></i>
                </div>
                <a href="other/admins/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->  
          @endif
          @if (Session::has('المشتركون'))
          <div class="col-lg-3 col-sm-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3></h3>
                  <p>  المشتركون</p>
                </div>
                <div class="icon">
                  <i class=""></i>
                </div>
                <a href="other/subscribers/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div>   
          @endif
            @if (Session::has('المشرفون'))
            <div class="col-lg-3 col-sm-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3><sup style="font-size: 20px"></sup></h3>
                    <p>  العملاء </p>
                  </div>
                  <div class="icon">
                    <i class=""></i>
                  </div>
                  <a href="other/clients/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                </div>
              </div><!-- ./col -->
            @endif
        </div><!-- /.row -->
    </section>
@endsection