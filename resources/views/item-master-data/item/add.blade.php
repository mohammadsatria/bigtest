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
                <input type="text" id="itemName" class="form-control col-md-7 col-xs-12" maxlength="50" name="itemName" />
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categoryId">Category <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">

                  <select id="categoryId" name="categoryId" class="form-control">
                    <option value=""></option>
                    @foreach ($category as $key => $val)
                        <option value="{{ $val->cat_id }}">{{ $val->cat_name }}</option>
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
                        <option value="{{ $val->spl_id }}">{{ $val->spl_name }}</option>
                    @endforeach
                  </select>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itemStock">Stock <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="itemStock" onkeypress="LIBS._isNumber(this.id)" name="itemStock" maxlength="3" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itemPrice">Price <span class="required">*</span>
              </label>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="itemPrice" onkeypress="LIBS._isCurrency(this.id)" name="itemPrice" maxlength="16" class="form-control col-md-7 col-xs-12 right-align">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itemPrice">Supplier Price
              </label>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="itemSupplierPrice" onkeypress="LIBS._isCurrency(this.id)" name="itemSupplierPrice" maxlength="16" class="form-control col-md-7 col-xs-12 right-align">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itemBarcodeId">Barcode <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="itemBarcodeId" onkeypress="LIBS._isNumber(this.id)" name="itemBarcodeId" maxlength="15" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button type="button" onClick="LIBS._goToPage('{{ route('item-index') }}')" class="btn btn-dark">Cancel</button>
              <button id="submit" type="button" onClick="store()" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
