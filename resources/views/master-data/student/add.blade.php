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
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="studentId">Student ID <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="studentId" class="form-control col-md-4" maxlength="15" name="studentId" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="studentName" class="form-control col-md-4" maxlength="50" name="studentName" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="studentGender">Gender <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="radio-custom">Male
                  <input type="radio" name="studentGender" id="studentGender" value="0" checked="checked" name="radio">
                  <span class="checkmark"></span>
                </label>

                <label class="radio-custom">Female
                  <input type="radio" name="studentGender" id="studentGender" value="1" name="radio">
                  <span class="checkmark"></span>
                </label>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="birthplace">Birth Place </label>
            <div class="col-md-4">
              <input type="text" id="studentBirthPlace" class="form-control col-md-4" maxlength="50" name="studentBirthPlace" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="birthdate">Birth Date (d/m/y)</label>
            <div class="col-md-4">
                <div class='input-group date' id='date'>
                    <input type='text' id="studentBirthDate" onkeypress="LIBS._inputDate(this.id)" name="studentBirthDate" class="form-control" />
                    <span class="input-group-addon" onclick="LIBS._isDatepicker('date')">
                       <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address
            </label>
            <div class="col-md-4">
                <textarea id="studentAddress" name="studentAddress" required="required" name="textarea" class="form-control col-md-7 col-xs-12"></textarea>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="classId">Class <span class="required">*</span>
            </label>
            <div class="col-md-4">
                <select id="classId" name="classId" class="form-control">
                  <option value=""></option>
                  @foreach ($classes as $key => $val)
                      <option value="{{ $val->cls_id }}">{{ $val->cls_name }}</option>
                  @endforeach
                </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Barcode ID <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="studentBarcodeId" name="studentBarcodeId" onkeypress="return LIBS._isNumber(this.id)" class="form-control col-md-4" maxlength="15" name="barcodeId" />
            </div>
          </div>

          {{-- image --}}
          <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">Photo
                </label>
                <div class="col-md-4">
                  <div class="input-group image-preview">
                   <input type="text" disabled class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->

                   <span class="input-group-btn">
                       <!-- image-preview-clear button -->
                       <button type="button" class="btn btn-default image-preview-clear" onclick="clearUrl()" style="display: none;">
                           <span class="glyphicon glyphicon-remove"></span> Clear
                       </button>
                       <!-- image-preview-input -->
                       <div class="btn btn-default image-preview-input">
                           <span class="glyphicon glyphicon-folder-open"></span>
                           <span class="image-preview-input-title">Choose File</span>
                           <input type="file" accept="image/png, image/jpeg, image/gif" onchange="readURL(this)" id="studentImage" name="input-file-preview"/> <!-- rename it -->
                       </div>
                   </span>
                </div>
                    <img id="img" style="display: none;" src="{{ asset('images/student-photo.png') }}" alt="..." class="preview-profile_img">
                    <input type="hidden" name="urlDefault" id="urlDefault" value="{{ asset('images/student-photo.png') }}">
              </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button type="button" onClick="LIBS._goToPage('{{ route('student-index') }}')" class="btn btn-dark">Cancel</button>
              <button id="submit" type="button" onClick="store()" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
