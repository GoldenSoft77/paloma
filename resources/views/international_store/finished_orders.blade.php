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

                @if (count($orders) > 0)
                <table class="MakeDataTable display">
                    <thead>
                    <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Receiver Name</th>
                                <th>Receiver City</th>
                                <th>Receiver Number</th>
                                
                               <!-- <th>User</th>  -->
                               

                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                                <td>
                                    {{ $order->id}}
                                </td>
                                <td>

                                    {{ $order->status }}
                                </td>

                                <td>
                                    {{ $order->amount }}
                                </td>
                                <td>
                                    {{ $order->receiver_name }}
                                </td>
                                <td>
                                    {{ $order->receiver_city }}
                                </td>
                                <td>
                                    {{ $order->receiver_number }}
                                </td>
                               <!-- @php
                                $first_name = $order->user->first_name;
                                $last_name = $order->user->last_name;
                                $full_name = $order." ".$last_name;
                                @endphp
                                <td>
                                  {{  $full_name }}
                                </td>
                             
                              -->
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