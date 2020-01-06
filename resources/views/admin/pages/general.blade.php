@extends('admin/layout/adminLayout')
@section('content')
        <section class="content-header">
                <h1>
                 عام
                <small> </small>
                </h1>
        </section>
      <!-- Main content -->
      <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-sm-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3></h3>
                    <p>  اللينكات</p>
                  </div>
                  <div class="icon">
                    <i class=""></i>
                  </div>
                  <a href="links/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-sm-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3><sup style="font-size: 20px"></sup></h3>
                    <p>  غلاف الشركة والصفحات </p>
                  </div>
                  <div class="icon">
                    <i class=""></i>
                  </div>
                  <a href="cover/" class="small-box-footer"> تعديل <i class="fa fa-arrow-circle-left"></i></a>
                </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-sm-4 col-xs-6">
              </div><!-- ./col -->

            </div><!-- /.row -->
        </section>
@endsection