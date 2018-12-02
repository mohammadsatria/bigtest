<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style media="screen">
    #table-list-detail tr td, #table-list-detail th {
        border: 1px solid #000;
    }

</style>
<?php
    $jml = 1;
?>
<div class="ln_solid"></div>
@foreach ($data as $key => $val)
    <table id="table-list-detail" class="table table-bordered jambo_table">
        <thead>
        @if ($jml == 1)
            <tr style="background: #fff; color: #73879C">
                <td colspan="7" align="center">
                    <h4>Customer Report Transaction {{ $period }}</h4>
                </td>
            </tr>
        @endif
            <tr style="background: #fff; color: #73879C">
                <td colspan="7">
                    <h4>Date : {{ dateFormat($key, 'Y-m-d', 'd F Y') }}</h4>
                </td>
            </tr>

            <tr>
                <th>No</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price/Unit</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $no = 1;
                $quantity_total = 0;
                $total_price = 0;
            ?>
            @foreach ($val as $index => $val1)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $val1['student_id'] }}</td>
                    <td>{{ $val1['student_name'] }}</td>
                    <td>{{ $val1['item'] }}</td>
                    <td align="center">{{ $val1['quantity'] }}</td>
                    <td align="right">{{ numberFormat($val1['price']) }}</td>
                    <td align="right">{{ numberFormat($val1['quantity'] * $val1['price']) }}</td>
                </tr>
                <?php
                    $quantity_total += $val1['quantity'];
                    $total_price += $val1['quantity'] * $val1['price'];
                    $no++;
                ?>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th>{{ $quantity_total }}</th>
                <th>-</th>
                <td align="right"><strong>{{ numberFormat($total_price) }}</strong></td>
            </tr>
        </tfoot>
    <?php $jml++ ?>
@endforeach
