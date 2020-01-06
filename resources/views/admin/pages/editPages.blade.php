@extends('admin/layout/adminLayout')
@section('content')
        <section class="content-header">
                <h1>
                تعديل الصفحات
                <small> </small>
                </h1>
        </section>
      <!-- Main content -->
      <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-sm-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3></h3>
                    <p> محتوي الصفحات </p>
                  </div>
                  <div class="icon">
                    <i class=" bag"></i>
                  </div>
                  <a href="content/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-sm-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3></h3>
                    <p>  الترجمة </p>
                  </div>
                  <div class="icon">
                    <i class=" "></i>
                  </div>
                  <a href="translation/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-sm-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3></h3>
                    <p>  الغلاف واللينكات </p>
                  </div>
                  <div class="icon">
                    <i class=" "></i>
                  </div>
                  <a href="others/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                </div>
              </div><!-- ./col -->

            </div><!-- /.row -->
        </section>
@endsection