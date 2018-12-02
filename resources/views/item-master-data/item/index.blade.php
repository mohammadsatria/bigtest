<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <button type="button" id="add-button" class="btn btn-round btn-success" onClick="LIBS._goToPage('{{route('item-add')}}')"><i class="fa fa-plus"></i> New Item</button>
        <div class="spacing"></div>
          <table id="datatable" class="table table-bordered jambo_table">
            <thead>
              <tr>
                <th width="3%">No</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Price</th>
                <th>Supplier Price</th>
                <th>Stock</th>
                <th>Barcode</th>
                <th id="action">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($data as $key => $val)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $val->itm_name }}</td>
                        <td>{{ $val->category->cat_name }}</td>
                        <td>{{ $val->supplier->spl_name }}</td>
                        <td class="right-align">{{ numberFormat($val->itm_price) }}</td>
                        <td class="right-align">{{ !empty($val->itm_supplier_price) ? numberFormat($val->itm_supplier_price) : '' }}</td>
                        <td class="center-align">{{ $val->itm_stock }}</td>
                        <td class="right-align">{{ $val->itm_barcode_id }}</td>
                        <td class="center-align" id="action">
                            <i class="fa fa-pencil fa-lg action" onClick="LIBS._goToPage('{{route('item-edit', [ 'id' => $val->itm_id ])}}')" data-toggle="tooltip" title="Edit" data-original-title="Edit"></i>
                            <i class="fa fa-trash fa-lg action" onClick="destroy('{{ $val->itm_id }}')" data-toggle="tooltip" title="Delete" data-original-title="Delete"></i>

                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
