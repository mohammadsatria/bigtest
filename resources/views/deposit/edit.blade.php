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
              <input type="text" id="studentId" value="{{ $row->student->std_id }}" disabled class="form-control col-md-4" maxlength="10" name="studentId" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="studentName" value="{{ $row->student->std_name }}" class="form-control col-md-4" maxlength="50" disabled name="studentName" />
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Date <span class="required">*</span>
            </label>
            <div class="col-md-4">
                    <div class='input-group date' id='date'>
                        <input type='text' value="{{ dateFormat($row->dps_date, 'Y-m-d', 'd/m/Y') }}" id="depositDate" onkeypress="LIBS._inputDate(this.id)" name="depositDate" class="form-control" />
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
                  <option {{ $row->dps_status == 1 ? 'selected' : '' }}  value="1">Add</option>
                  <option {{ $row->dps_status == 0 ? 'selected' : '' }}  value="0">Deduct</option>
                </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Amount <span class="required">*</span>
            </label>
            <div class="col-md-4">
              <input type="text" id="depositValue" value="{{ numberFormat($row->dps_value) }}" name="depositValue" onkeypress="LIBS._isCurrency(this.id)" class="form-control col-md-4 right-align" maxlength="15" name="depositValue" />
              <input type="hidden" id="studentCtr" name="studentCtr" value="{{ $row->student->std_ctr }}" />
              <input type="hidden" id="depositId" name="depositId" value="{{ $row->dps_id }}" />
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button type="button" onClick="LIBS._goToPage('{{ route('deposit-detail', [ 'stdId' => $row->student->std_ctr ]) }}')" class="btn btn-dark">Cancel</button>
              <button id="submit" type="button" onClick="save()" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
