<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
          <div class="row">
             <div class="col-md-10 col-md-offset-2">
                 <form class="form-horizontal form-label-left" name="reportIncomeForm" id="reportIncomeForm">
                   <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dateFrom">Date From (d/m/y)</label>
                     <div class="col-md-3">
                         <div class="input-group date" id="dateFrom">
                             <input type="text" id="dateFromReport" onkeypress="LIBS._inputDate(this.id)" name="dateFromReport" class="form-control" />
                             <span class="input-group-addon" onclick="LIBS._isDatepicker('dateFrom')">
                                <span class="glyphicon glyphicon-calendar"></span>
                             </span>
                         </div>
                     </div>
                   </div>

                   <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dateTo">Date To (d/m/y)</label>
                     <div class="col-md-3">
                         <div class="input-group date" id="dateTo">
                             <input type='text' id="dateToReport" onkeypress="LIBS._inputDate(this.id)" name="dateToReport" class="form-control" />
                             <span class="input-group-addon" onclick="LIBS._isDatepicker('dateTo')">
                                <span class="glyphicon glyphicon-calendar"></span>
                             </span>
                         </div>
                     </div>
                   </div>

                   <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplierId">Supplier</label>
                     <div class="col-md-3">
                         <select id="supplierId" name="supplierId" class="form-control">
                           <option value="0">All Supplier</option>
                           @foreach ($supplier as $key => $val)
                               <option value="{{ $val->spl_id }}">{{ $val->spl_name }}</option>
                           @endforeach
                         </select>
                     </div>
                   </div>
                 </form>

             </div>
          </div>

          <div class="row">
              <div class="ln_solid"></div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="button" onClick="reset()" class="btn btn-dark">Reset</button>
                      <button id="submit" type="button" onClick="process(1)" class="btn btn-primary">Ok</button>

                      <button id="export" type="button" onClick="process(0)" class="btn btn-success"><span class="fa fa-file-excel-o"></span> Export Excel</button>
                  </div>
              </div>
          </div>

         <div id="list-income-table">

         </div>

        <h4 id="grand-total"></h4>

        <div class="ln_solid"></div>
        <div class="col-md-6">
            <button id="payment-process" type="button" onClick="clearList()" class="btn btn-danger hidden-div">Clear List Of Item</button>
        </div>
          <div class="col-md-6 pull-right right-align">
            <button id="payment-process" type="button" onClick="LIBS._goToPage('{{ route('transaction-payment') }}')" class="btn btn-success hidden-div">Payment Process</button>
        </div>
      </div>
    </div>
  </div>
</div>
