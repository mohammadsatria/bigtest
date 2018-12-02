<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <button type="button" id="add-button" class="btn btn-round btn-success" onClick="LIBS._goToPage('{{route('class-add')}}')"><i class="fa fa-plus"></i> New Class</button>

          <div class="spacing">
          </div>

          <table id="datatable" class="table table-bordered jambo_table">
            <thead>
              <tr>
                <th width="3%">No</th>
                <th>Class Name</th>
                <th width="15%" id='action'>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($data as $key => $val)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $val->cls_name }}</td>
                        <td id='action' class="center-align">
                            <i class="fa fa-pencil fa-lg action" onClick="LIBS._goToPage('{{route('class-edit', [ 'id' => $val->cls_id ])}}')" data-toggle="tooltip" title="Edit" data-original-title="Edit"></i>
                            <i class="fa fa-trash fa-lg action" onClick="destroy('{{ $val->cls_id }}')" data-toggle="tooltip" title="Delete" data-original-title="Delete"></i>

                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
