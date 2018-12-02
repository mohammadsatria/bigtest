<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h4>{{ $subTitle }}</h4>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <form class="form-horizontal form-label-left" name="menuForm" id="classForm" data-parsley-validate="">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">User Type <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="usertypeName" class="form-control col-md-4" value="{{ $data->ust_name }}" maxlength="50" name="usertypeName" />
              <input type="hidden" id="usertypeId" name="usertypeId" value="{{ $data->ust_id }}">
              <input type="hidden" id="_method" name="_method" value="PUT">
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button type="button" onClick="LIBS._goToPage('{{ route('usertype-index') }}')" class="btn btn-dark">Cancel</button>
              <button id="submit" type="button" onClick="save()" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
