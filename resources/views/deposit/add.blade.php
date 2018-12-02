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
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Student ID <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="studentId" value="{{ $student->std_id }}" disabled class="form-control col-md-4" maxlength="10" name="studentId" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="studentName" value="{{ $student->std_name }}" class="form-control col-md-4" maxlength="50" disabled name="studentName" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="depositDate">Date (d/m/y) <span class="required">*</span>
            </label>
            <div class="col-md-4">
                <div class='input-group date' id='date'>
                    <input type='text' id="depositDate" onkeypress="LIBS._inputDate(this.id)" name="depositDate" class="form-control" />
                    <span class="input-group-addon" onclick="LIBS._isDatepicker('date')">
                       <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
          </div>
          
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="depositStatus">Status <span class="required">*</span>
            </label>
            <div class="col-md-4">

                <select id="depositStatus" name="depositStatus" class="form-control">
                  <option value=""></option>
                  <option value="1">Add</option>
                  <option value="0">Deduct</option>
                </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Amount <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="depositValue" name="depositValue" onkeypress="LIBS._isCurrency(this.id)" class="form-control col-md-4 right-align" maxlength="15" name="depositValue" />
              <input type="hidden" id="studentCtr" name="studentCtr" value="{{ $student->std_ctr }}" />
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button type="button" onClick="LIBS._goToPage('{{ route('deposit-detail', [ 'stdId' => $student->std_ctr ]) }}')" class="btn btn-dark">Cancel</button>
              <button id="submit" type="button" onClick="store()" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
