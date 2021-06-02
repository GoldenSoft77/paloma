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
                    <h5>Online Store Pending Orders:
                    </h5>


                    @if (count($pending_orders) > 0)
                    <!-- ./Add New Slide Btn -->
                    <table class="MakeDataTable display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Receiver Name</th>
                                <th>Receiver City</th>
                                <th>Receiver Number</th>
                                <!-- <th>User</th> -->
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pending_orders as $pending_order)
                            <tr>
                                <td>
                                    {{ $pending_order->id}}
                                </td>
                                <td>

                                    {{ $pending_order->status }}
                                </td>

                                <td>
                                    {{ $pending_order->amount }}
                                </td>
                                <td>
                                    {{ $pending_order->receiver_name }}
                                </td>
                                <td>
                                    {{ $pending_order->receiver_city }}
                                </td>
                                <td>
                                    {{ $pending_order->receiver_number }}
                                </td>
                                <!-- @php
                                $first_name = $pending_order->user->first_name;
                                $last_name = $pending_order->user->last_name;
                                $full_name = $pending_order." ".$last_name;
                                @endphp
                                <td>
                                  {{  $full_name }}
                                </td>
                               -->
                                <td>

                                    <a href="{{ url('admin/internationalorders/edit/'.$pending_order->id) }}">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    &nbsp;
                                    <a href="{{ url('admin/internationalorders/change/'.$pending_order->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>

                            </tr>


                            @endforeach
                        </tbody>
                    </table>

                    @else
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            There is no Pending Orders right now!
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