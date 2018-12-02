<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
          <table id="datatable" class="table table-bordered jambo_table">
            <thead>
              <tr>
                <th width="3%">No</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Class</th>
                <th>Barcode</th>
                <th>Balance</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($data as $key => $val)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $val->std_id }}</td>
                        <td>{{ $val->std_name }}</td>
                        <td>{{ $val->classes->cls_name }}</td>
                        <td class="right-align">{{ $val->std_barcode_id }}</td>
                        <td class="right-align">Rp. {{ numberFormat($val->balance) }}</td>
                        <td class="center-align">
                            <i class="fa fa-th-list fa-lg action" onClick="LIBS._goToPage('{{ route('deposit-detail', [ 'stdId' => $val->std_ctr ]) }}')" data-toggle="tooltip" title="Detail" data-original-title="Detail"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
