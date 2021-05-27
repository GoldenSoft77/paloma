@include('layouts.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid p-5">

            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('admin/products/store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Product Sections</label>
                            <select name="product_section" class="form-control" required>
                                @foreach($sections as $section)
                                <option value="{{$section->id}}">{{$section->name}} </option>

                                @endforeach


                            </select>

                        </div>

                        <div class="form-group">
                            <label>Vendor</label>
                            <select name="vendor_id" class="form-control" required>
                                @foreach($vendors as $vendor)
                                <option value="{{$vendor->id}}">{{$vendor->shop_name}} </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">
                            <label>Product name </label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Product description</label>
                            <small>Go down to a new line to add a new count to the list (press Enter)</small>
                            <textarea name="product_desc" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Product price:</label>
                            <input type="text" name="product_price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Product count:</label>
                            <input type="number" min="0" name="product_count" class="form-control" required>
                        </div>

                        <div class="clear"></div>
                        <div class="form-group">
                            <label>Product main image:</label>
                            <input type="file"  name="img" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Product secondary images:</label>
                            <small>You can upload multi images</small>
                            <input type="file"  name="images[]" class="form-control" multiple>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
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