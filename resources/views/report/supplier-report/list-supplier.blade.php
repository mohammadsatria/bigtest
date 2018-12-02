<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style media="screen">
    #table-list-detail tr td, #table-list-detail th {
        border: 1px solid #000;
    }

</style>
<?php
    $anuan      = count($data);
    $jml        = 1;
?>
<div class="ln_solid"></div>
@foreach ($data as $key => $val)
    <table id="table-list-detail" class="table table-bordered jambo_table">
        <thead>
        @if ($jml == 1)
            <tr style="background: #fff; color: #73879C">
                <td colspan="6" align="center">
                    <h4>Supplier Report {{ $period }}</h4>
                </td>
            </tr>
        @endif
            <tr style="background: #fff; color: #73879C">
                <td colspan="6">
                    <h4>Supplier : {{ $key }}</h4>
                </td>
            </tr>
            <tr>
                <th align="center">No</th>
                <th align="center">Item</th>
                <th align="center">Sold</th>
                <th align="center">Remaining</th>
                <th align="center">Supplier Price / Unit</th>
                <th align="center">Supplier Payment</th>
            </tr>
        </thead>
        <?php
            $no        = 1;
            $sold      = 0;
            $remaining = 0;
            $total     = 0;
        ?>
        <tbody>
        @foreach ($val as $key => $value)
                <tr>
                    <td align="center">{{ $no }}</td>
                    <td>{{ $value['item'] }}</td>
                    <td align="center" >{{ $value['sold'] }}</td>
                    <td align="center" >{{ $value['remaining'] }}</td>
                    <td align="right" >{{ !empty($value['supplierPrice']) ? numberFormat($value['supplierPrice']) : 0 }}</td>
                    <td align="right" >{{ !empty($value['supplierPrice']) ? numberFormat($value['supplierPrice'] * $value['sold']) : 0 }}</td>
                </tr>
        <?php
            $sold       += $value['sold'];
            $remaining  += $value['remaining'];
            $total      += $value['supplierPrice'] * $value['sold'];
            $no++;
        ?>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2" align="center">Total</th>
            <th align="center" >{{ $sold }}</th>
            <th align="center" >{{ $remaining }}</th>
            <th align="center" ></th>
            <td align="right" ><strong>{{ numberFormat($total) }}<strong></td>
        </tr>
    </tfoot>

    </table>
    <?php $jml++; ?>
@endforeach
