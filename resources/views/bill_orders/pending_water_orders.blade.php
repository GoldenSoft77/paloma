
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
            <h5> Water Pending Orders: 
            </h5>
          </div>
          <!-- ./Add New Slide Btn -->

          @if (count($billorders) > 0)

          @foreach ($billorders as $billorder)
          <div class="col-md-4 col-sm-6 col-12 mb-3">
            <div class="single-box">
           
            <h3>Name: {{ $billorder->name }}</h3>
            <p>City: {{ $billorder->city }}</p>
            <p>Counter Number: {{ $billorder->counter_number }}</p>
              <ul>
              <li>
                <a href="{{ url('admin/billorders/approve/'.$billorder->id) }}">
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
              There is no Pending Water Orders right now!
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
