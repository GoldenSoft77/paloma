@include('layouts.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid p-5">

            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Order Status</h3>
                </div>
                <div class="col-12 mb-3">
                    <h5> Order Details </h5>
                </div>
                @foreach ($order_details as $order_detail)
                <div class="col-md-4 col-sm-6 col-12 mb-3">
                    <div class="single-box">

                        <p>Product: {{ $order_detail->website_link }}</p>
                      

                    </div>
                </div>
                @endforeach

                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('admin/internationalorders/change_status/'. $order->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <select name="status" class="form-control" required>


                            <option value="{{$order->status}}" selected>{{$order->status}} </option>
                            <option value="New">New </option>
                            <option value="Awaiting payment">Awaiting payment </option>
                            <option value="Encapsulation">Encapsulation </option>
                            <option value="Shipping">Shipping </option>
                            <option value="Done">Done </option>




                        </select>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('layouts.footer')