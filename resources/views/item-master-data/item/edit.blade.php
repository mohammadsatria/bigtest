<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h4>{{ $subTitle }}</h4>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <form class="form-horizontal form-label-left" name="categoryForm" id="classForm" data-parsley-validate="">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itemName">Item Name <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" value="{{ $row->itm_name }}" id="itemName" class="form-control col-md-7 col-xs-12" maxlength="50" name="itemName" />
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categoryId">Category <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">

                  <select id="categoryId" name="categoryId" class="form-control">
                    <option value=""></option>
                    @foreach ($category as $key => $val)
                        <option {{ $row->cat_id == $val->cat_id ? 'selected' : '' }} value="{{ $val->cat_id }}">{{ $val->cat_name }}</option>
                    @endforeach
                  </select>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplierId">Supplier <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="supplierId" name="supplierId" class="form-control">
                      <option value=""></option>
                    @foreach ($supplier as $key => $val)
                        <option {{ $row->spl_id == $val->spl_id ? 'selected' : '' }} value="{{ $val->spl_id }}">{{ $val->spl_name }}</option>
                    @endforeach
                  </select>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itemStock">Stock <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" onkeypress="LIBS._isNumber(this.id)" value="{{ $row->itm_stock }}" id="itemStock" name="itemStock" maxlength="3" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itemPrice">Price <span class="required">*</span>
              </label>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" value="{{ numberFormat($row->itm_price) }}" onkeypress="LIBS._isCurrency(this.id)" id="itemPrice" name="itemPrice" maxlength="13" class="form-control col-md-7 col-xs-12 right-align">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itemPrice">Supplier Price
              </label>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" value="{{ !empty($row->itm_supplier_price) ?  numberFormat($row->itm_supplier_price) : '' }}" onkeypress="LIBS._isCurrency(this.id)" id="itemSupplierPrice" name="itemSupplierPrice" maxlength="13" class="form-control col-md-7 col-xs-12 right-align">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itemBarcodeId">Barcode
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" onkeypress="LIBS._isNumber(this.id)" value="{{ $row->itm_barcode_id }}" id="itemBarcodeId" name="itemBarcodeId" maxlength="15" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <input type="hidden" value="{{ $row->itm_id }}" id="itemId" maxlength="50" name="itemId" />
              <button type="button" onClick="LIBS._goToPage('{{ route('item-index') }}')" class="btn btn-dark">Cancel</button>
              <button id="submit" type="button" onClick="save()" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
