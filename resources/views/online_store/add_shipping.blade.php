@include('layouts.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid p-5">
      
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Shipping Cost</h3>
                </div>
                <div class="col-12 mb-3">
                    <h5> Order Details </h5>
                </div>
                @foreach ($order_details as $order_detail)
                <div class="col-md-4 col-sm-6 col-12 mb-3">
                    <div class="single-box">
                 
                    <p>Product: {{ $order_detail->product->name }}</p>
                    <p>Price: {{ $order_detail->price }}</p>
                    <p>Quantity: {{ $order_detail->quantity }}</p>
                 
                    </div>
                </div>
                @endforeach

                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('admin/onlineorders/add_shipping/'. $order->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Amount *</label>
                            <input type="text" class="form-control" name="amount" value="{{$order->amount}}" required
                                readonly>

                        </div>

                        <div class="form-group">
                            <label>Shipping Cost *</label>
                            <input type="text" class="form-control" name="shipping" required>

                        </div>

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