<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
          <div class="row">
              <div class="col-md-6">
                  <table class="detail-deposit">
                        <tr>
                            <th width="30%">Student ID</th>
                            <th width="5%">:</th>
                            <th>{{ $student->std_id }}</th>
                        </tr>
                        <tr>
                            <th width="30%">Name</th>
                            <th width="5%">:</th>
                            <th>{{ $student->std_name }}</th>
                        </tr>

                  </table>
              </div>

              <div class="col-md-6">
                  <table class="detail-deposit">
                      <tr>
                          <th width="30%">Class</th>
                          <th width="5%">:</th>
                          <th>{{ $student->classes->cls_name }}</th>
                      </tr>
                        <tr>
                            <th width="30%">Barcode</th>
                            <th width="5%">:</th>
                            <th>{{ $student->std_barcode_id }}</th>
                        </tr>
                  </table>
              </div>
          </div>

        <div class="spacing"></div>
        <button type="button" id="add-button" class="btn btn-round btn-success" onClick="LIBS._goToPage('{{route('deposit-add', [ 'stdId' => $student->std_ctr ])}}')"><i class="fa fa-plus"></i> New Deposit</button>
        <div class="spacing"></div>

          <table id="datatable" class="table table-bordered jambo_table">
              <thead>
                <tr>
                  <th width="3%">No</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Amount</th>
                  <th>Balance</th>
                  <th id="action">Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $balance = 0;
                  ?>
                  @foreach ($data as $key => $val)
                      <tr>
                          <td align="center">{{ $no++ }}</td>
                          <td class="right-align">{{ dateFormat($val->dps_date, 'Y-m-d', 'd M Y') }}</td>
                          <td>{{ $val->dps_status == 1 ? 'Add' : 'Deduct' }}</td>
                          <td class="right-align">Rp. {{ numberFormat($val->dps_value) }}</td>
                          <td class="right-align">Rp. {{ $val->dps_status == 1 ? numberFormat($balance+=$val->dps_value) : numberFormat($balance-=$val->dps_value)  }}</td>
                          <td class="center-align" id="action">
                              <i class="fa fa-pencil fa-lg action" onClick="LIBS._goToPage('{{route('deposit-edit', [ 'id' => $val->dps_id ])}}')" data-toggle="tooltip" title="Edit" data-original-title="Edit"></i>
                              <i class="fa fa-trash fa-lg action" onClick="destroy('{{ $val->dps_id }}')" data-toggle="tooltip" title="Delete" data-original-title="Delete"></i>
                          </td>
                      </tr>
                  @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td class="center-align" colspan="4"><strong>Balance<strong></td>
                    <td class="right-align"><strong>Rp. {{ numberFormat($balance) }}</strong></td>
                    <td id="action">-</td>
                </tr>
            </tfoot>
          </table>

          <div class="ln_solid"></div>
            <div class="col-md-6">
              <button type="button" onClick="LIBS._goToPage('{{ route('deposit-index') }}')" class="btn btn-dark">Back</button>
            </div>

      </div>
    </div>
  </div>
</div>
