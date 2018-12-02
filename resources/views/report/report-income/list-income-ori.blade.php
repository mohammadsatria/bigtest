<?php
    $grandTotal = 0;
    $anuan      = count($data);
    $jml        = 1;
    $quantity   = 0;
?>
<div class="ln_solid"></div>
@foreach ($data as $key => $val)
    <table id="table-list-detail" class="table table-bordered jambo_table">
        <thead>
        @if ($jml == 1)
            <tr style="background: #fff; color: #73879C">
                <td colspan="5" align="center">
                    <h4>Report Of Income {{ $period }}</h4>
                </td>
            </tr>
        @endif
            <tr style="background: #fff; color: #73879C">
                <td colspan="5">
                    <h4>Date : {{ dateFormat($key, 'Y-m-d', 'd F Y') }}</h4>
                </td>
            </tr>
            <tr>
                <th align="center">No</th>
                <th align="center">Item</th>
                <th align="center">Qty</th>
                <th align="center">Item Price/Unit</th>
                <th align="center">Total</th>
            </tr>
        </thead>
        <?php
            $no            = 1;
            $total         = 0;
            $grandQuantity = 0;
        ?>
        <tbody>
        @foreach ($val as $key => $value)
                <tr>
                    <td align="center">{{ $no }}</td>
                    <td>{{ $value['item'] }}</td>
                    <td align="center" >{{ $value['quantity'] }}</td>
                    <td align="right">Rp. {{ numberFormat($value['price']) }}</td>
                    <td align="right">Rp. {{ numberFormat($value['quantity'] * $value['price']) }}</td>
                </tr>
        <?php
            $grandQuantity += $value['quantity'];
            $total         += $value['quantity'] * $value['price'];
            $grandTotal    += $value['quantity'] * $value['price'];
            $quantity      += $value['quantity'];
            $no++;
        ?>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"  style="font-weight: bold;" align="center">Total</td>
            <td align="center" style="font-weight: bold;" >{{ $grandQuantity }}</td>
            <td align="right">-</td>
            <td align="right" style="font-weight: bold;" >Rp. {{ numberFormat($total) }}</td>
        </tr>

        @if ($anuan == $jml)
            <tr id="grandtotal">
                <td colspan="2" align="center"><strong>Grand Total</strong></td>
                <td align="center"><strong>{{ $quantity }}</strong></td>
                <td align="right">-</td>
                <td align="right"><strong>Rp. {{ numberFormat($grandTotal) }}</strong></td>
            </tr>
        @endif
    </tfoot>
    </table>
    <?php $jml++; ?>
@endforeach
