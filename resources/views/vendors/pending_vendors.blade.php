
@include('layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid p-5">
        <div class="row">


          <!-- Message -->
          @if(session()->has('message'))
          <p class="message-box done">
            {{ session()->get('message') }}
          </p>
          @endif
          <!-- ./Message -->

          <!-- Add New Slide Btn -->
          <div class="col-12 mb-3">
            <h5>  Pending Vendors: 
            </h5>
          </div>
          <!-- ./Add New Slide Btn -->

          @if (count($pending_vendors) > 0)

          @foreach ($pending_vendors as $pending_vendor)
          <div class="col-md-4 col-sm-6 col-12 mb-3">
            <div class="single-box">
          
            <h3>Shop Name: {{ $pending_vendor->shop_name }}</h3>
            <p>Shop Phone Number: {{ $pending_vendor->shop_phone_number }}</p>
            <p>Shop Address: {{ $pending_vendor->shop_address }}</p>
              <ul>
              <li>
                <a href="{{ url('admin/vendors/approve/'.$pending_vendor->id) }}">
                  <i class="fas fa-check"></i>
                </a>
              </li>
             
            </ul>
       
            </div>
          </div>
          @endforeach

          @else
          <div class="col-12">
            <div class="alert alert-primary" role="alert">
              There is no Pending Vendors right now!
            </div>
          </div>  
          @endif

        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@include('layouts.footer')
