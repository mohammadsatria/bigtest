<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
          <button type="button" id="add-button" class="btn btn-round btn-success" onClick="LIBS._goToPage('{{route('student-add')}}')"><i class="fa fa-plus"></i> New Student</button>
          <div class="spacing"></div>
          <table id="datatable" class="table table-bordered jambo_table">
            <thead>
              <tr>
                <th width="3%">No</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Class</th>
                <th>Barcode</th>
                <th width="5%">Detail</th>
                <th id="action">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($data as $key => $val)
                    <tr>
                        <td class="center-align">{{ $no++ }}</td>
                        <td>{{ $val->std_id }}</td>
                        <td>{{ $val->std_name }}</td>
                        <td>{{ $val->classes->cls_name }}</td>
                        <td class="right-align">{{ $val->std_barcode_id }}</td>
                        <td class="center-align">
                            <i class="fa fa-th-list fa-lg action" onClick="detail( {{ $val->std_ctr }})" data-toggle="tooltip" title="Detail" data-original-title="Detail"></i>
                        </td>
                        <td id="action" class="center-align">
                            <i class="fa fa-pencil fa-lg action" onClick="LIBS._goToPage('{{route('student-edit', [ 'id' => $val->std_ctr ])}}')" data-toggle="tooltip" title="Edit" data-original-title="Edit"></i>
                            <i class="fa fa-trash fa-lg action" onClick="destroy('{{ $val->std_ctr }}')" data-toggle="tooltip" title="Delete" data-original-title="Delete"></i>

                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
