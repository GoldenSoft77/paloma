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

                @if (count($balanceorders) > 0)
                <table class="MakeDataTable display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Number</th>
                            <th>Units</th>
                            <th>Company</th>
                            <th>User</th>
                            <th>Date</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($balanceorders as $balanceorder)
                        <tr>
                            <td>{{ $balanceorder->id }}</td>
                            <td>{{ $balanceorder->phone_number }}</td>
                            <td>{{ $balanceorder->packages->units }}</td>
                            <td>{{ $balanceorder->packages->company }}</td>
                            @php
                                $first_name = $balanceorder->user->first_name;
                                $last_name = $balanceorder->user->last_name;
                                $full_name = $first_name." ".$last_name;
                                @endphp
                                <td>
                                  {{  $full_name }}
                                </td>
                            <td>{{ $balanceorder->created_at->format('Y-m-d') }}</td>
                          
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
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@include('layouts.footer')