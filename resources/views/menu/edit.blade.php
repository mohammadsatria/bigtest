<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h4>{{ $subTitle }}</h4>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <?php
            $menuId     = 'mlv'.$level. '_id';
            $menuName   = 'mlv'.$level. '_name';
            $menuParent = 'mlv'.$level. '_parent_id';
            $menuOrder  = 'mlv'.$level. '_order';
            $menuIcon   = 'mlv'.$level. '_icon';
            $menuUrl    = 'mlv'.$level. '_url';
            $menuActive = 'mlv'.$level. '_active';

            $parentLev  = $level - 1;
            $parentId   = $parentLev != 0 ? 'mlv'.$parentLev.'_id' : '';
            $parentName = $parentLev != 0 ? 'mlv'.$parentLev.'_name' : '';
          ?>

        <form class="form-horizontal form-label-left" name="menuForm" id="menuForm" data-parsley-validate="">
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Menu Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="menuName" value="{{ $data->$menuName }}" class="form-control col-md-7 col-xs-12" maxlength="35" name="menuName" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Level <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">

                <select id="menuLevel" name="menuLevel" class="form-control" onChange="getMenuParent(this.value)">
                  <option value=""></option>
                  <option {{ $level == 1 ? 'selected' : '' }} value="1">Level 1</option>
                  <option {{ $level == 2 ? 'selected' : '' }} value="2">Level 2</option>
                  <option {{ $level == 3 ? 'selected' : '' }} value="3">Level 3</option>
                </select>
            </div>
          </div>

          <div style="{{ $level != 1 ? 'display: block' : ''  }}" class="item form-group hidden-div">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuParent">Parent <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="menuParent" name="menuParent" class="form-control" onChange="getOrder()">
                    @if (isset($parent))
                        @foreach ($parent as $key => $val)
                            <option {{ $data->$menuParent == $val->$parentId ? 'selected' : '' }} value="{{ $val->$parentId }}">{{ $val->$parentName }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
          </div>

          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuOrder">Order
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="menuOrder" class="form-control" name="menuOrder">
                      @for ($i = 1; $i <= $count; $i++ )
                        <option {{ $data->$menuOrder == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                      @endfor
                  </select>
              </div>
          </div>

          <div  style="{{ $level == 1 ? 'display: block' : ''  }}" class="item form-group icon-div">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuIcon">Icon <span class="required">*</span>
            </label>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="menuIcon" value="{{ $data->$menuIcon }}" name="menuIcon" maxlength="25" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuUrl">URL
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="url" id="menuUrl" name="menuUrl" value="{{ $data->$menuUrl }}" maxlength="30" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuStatus">Status <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="radio-custom">Active
                  <input type="radio" name="menuActive" id="menuActive" {{ $data->$menuActive == 1 ? 'checked' : '' }}  value="1" class='menuActive'>
                  <span class="checkmark"></span>
                </label>

                <label class="radio-custom">Non Active
                  <input type="radio" name="menuActive" id="menuActive" {{ $data->$menuActive == 0 ? 'checked' : '' }}  value="0" class='menuNonActive'>
                  <span class="checkmark"></span>
                </label>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <!-- id , and method  -->
              <input type="hidden" id="_method" value="put" class="form-control col-md-7 col-xs-12" maxlength="35" name="_method" />
              <input type="hidden" id="id" value="{{ $data->$menuId }}" class="form-control col-md-7 col-xs-12" maxlength="35" name="id" />
              <input type="hidden" id="prevLevel" value="{{ $level }}" class="form-control col-md-7 col-xs-12" maxlength="35" name="prevLevel" />
              <input type="hidden" id="prevOrder" value="{{ $data->$menuOrder }}" class="form-control col-md-7 col-xs-12" maxlength="35" name="prevLevel" />

              <button type="button" onClick="LIBS._goToPage('{{ route('menu-index') }}')" class="btn btn-primary">Cancel</button>
              <button id="submit" type="button" onClick="save()" class="btn btn-success">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
