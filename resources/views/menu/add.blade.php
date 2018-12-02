<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h4>{{ $subTitle }}</h4>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <form class="form-horizontal form-label-left" name="menuForm" id="menuForm" data-parsley-validate="">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Menu Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="menuName" class="form-control col-md-7 col-xs-12" maxlength="35" name="menuName" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Level <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">

                <select id="menuLevel" name="menuLevel" class="form-control" onChange="getMenuParent(this.value)">
                  <option value=""></option>
                  <option value="1">Level 1</option>
                  <option value="2">Level 2</option>
                  <option value="3">Level 3</option>
                </select>
            </div>
          </div>

          <div class="item form-group hidden-div">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuParent">Parent <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="menuParent" name="menuParent" class="form-control" onChange="getOrder()">
                </select>
            </div>
          </div>

          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuOrder">Order
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="menuOrder" class="form-control" name="menuOrder">
                  </select>
              </div>
          </div>

          <div class="item form-group icon-div">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuIcon">Icon <span class="required">*</span>
            </label>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="menuIcon" name="menuIcon" maxlength="25" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuUrl">URL
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="url" id="menuUrl" name="menuUrl" maxlength="30" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuStatus">Status <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="radio-custom">Active
                  <input type="radio" name="menuActive" id="menuActive" value="1" checked="checked" name="radio">
                  <span class="checkmark"></span>
                </label>

                <label class="radio-custom">Non Active
                  <input type="radio" name="menuActive" id="menuActive" value="0" name="radio">
                  <span class="checkmark"></span>
                </label>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button type="button" onClick="LIBS._goToPage('{{ route('menu-index') }}')" class="btn btn-primary">Cancel</button>
              <button id="submit" type="button" onClick="store()" class="btn btn-success">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
