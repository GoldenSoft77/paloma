
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
          <h5> Finished Orders: 
          </h5>
       
        <!-- ./Add New Slide Btn -->

        @if (count($billorders) > 0)
        <table class="MakeDataTable display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>User</th>
                            <th>Date</th>
                           
                        </tr>
                    </thead>
                    <tbody>
        @foreach ($billorders as $billorder)
        <tr>
           <td>{{ $billorder->id }}</td>  
           <td>{{ $billorder->type }}</td>
           <td>{{ $billorder->amount }}</td>
           @php
                                $first_name = $billorder->user->first_name;
                                $last_name = $billorder->user->last_name;
                                $full_name = $first_name." ".$last_name;
                                @endphp
                                <td>
                                  {{  $full_name }}
                                </td>
           <td>{{ $billorder->created_at->format('Y-m-d') }}</td>
           
         </tr>           
         @endforeach
                    </tbody>
                </table>


        @else
        <div class="col-12">
          <div class="alert alert-primary" role="alert">
            There is no Finished orders right now!
          </div>
        </div>  
        @endif
        </div>
      </div>
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@include('layouts.footer')
