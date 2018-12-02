<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h4>{{ $subTitle }}</h4>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <form class="form-horizontal form-label-left" name="supplierForm" id="classForm" data-parsley-validate="">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplierName">Supplier Name <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="supplierName" value="{{ $row->spl_name }}" class="form-control col-md-4" maxlength="35" name="supplierName" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">No Handphone <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="supplierNoHp" value="{{ $row->spl_no_hp }}" onkeypress="return LIBS._isNumber(this.id)" class="form-control col-md-4" maxlength="15" name="supplierNoHp" />
              <input type="hidden" id="supplierId" value="{{ $row->spl_id }}" name="supplierId" />
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button type="button" onClick="LIBS._goToPage('{{ route('supplier-index') }}')" class="btn btn-dark">Cancel</button>
              <button id="submit" type="button" onClick="save()" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
