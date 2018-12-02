<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="x_panel">
      <div class="x_content">
          <fieldset>
              <legend>Item List</legend>
              <div class="row">
                 <div class="col-md-10 col-md-offset-2">
                     <form class="form-horizontal form-label-left" name="transactionFrom" id="transactionForm" data-parsley-validate="">
                         <div class="item form-group">
                             <label class="control-label col-md-3" for="name">Quantity</label>
                             <div class="col-md-2">
                                 <input type="number" min="1" id="quantity" maxlength="3" value="1" onkeypress="LIBS._isNumber(this.id)"  class="form-control col-md-2 center-align" maxlength="3" name="quantity" />
                             </div>
                         </div>

                         <div class="item form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Item Barcode</label>
                             <div class="col-md-3">
                                 <input type="text" name="barcodeItem" id="barcodeItem" autofocus onkeypress="LIBS._isNumber(this.id)" maxlength="15" onfocus="getBarcodeItem()" onchange="getDataItem()" class="form-control col-md-10"/>
                                 <input type="hidden"  id="payment-url" value="{{ route('transaction-payment') }}"  class="form-control col-md-2 center-align" />
                             </div>
                         </div>
                     </form>
                 </div>
              </div>

            <div class="spacing"></div>
            <h4>List Of Detail Transaction</h4>
            <table id="table-list-detail" class="table table-bordered jambo_table">
              <thead>
                <tr>
                  <th width="3%">No</th>
                  <th>Item Name</th>
                  <th>Qty</th>
                  <th>Item Price/Unit</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                      <td colspan="6" class="center-align">No data found</td>
                  </tr>
              </tbody>
            </table>
            <h4 id="grand-total"></h4>

            <div class="ln_solid"></div>
            <div class="col-md-6">
                <button id="payment-process" type="button" onClick="clearList()" class="btn btn-danger">Clear List Of Item</button>
            </div>
          </fieldset>
      </div>
    </div>

  </div>
</div>
<div class="row" id="payment-procces-div">
  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="x_panel">
        <fieldset>
            <legend>Payment Process</legend>
            <div class="x_content">
               <div class="row">
                      <div class="col-md-10 col-md-offset-2">
                          <form class="form-horizontal form-label-left" name="transactionFrom" id="transactionForm" data-parsley-validate="">
                              <div class="item form-group" style="display: none">
                                  <div class="col-md-2">
                                      <input type="number" min="1" value="1" class="form-control col-md-2 center-align" maxlength="3" />
                                      <input type="hidden" name="studentCtr" id="studentCtr"/>
                                  </div>
                              </div>

                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Student Barcode</label>
                                  <div class="col-md-3">
                                      <input type="text" name="studentBarcode" autofocus id="studentBarcode" onkeypress="LIBS._isNumber(this.id)" maxlength="15" onfocus="getAllStudentBarcode()" onchange="getStudent()" class="form-control col-md-10"/>

                                  </div>
                              </div>

                              <div class="item form-group hidden-div">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Student ID :
                                </label>
                                <div class="col-md-4">
                                    <h5 class="studentId"></h5>
                                </div>
                              </div>

                              <div class="item form-group hidden-div">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name :
                                </label>
                                <div class="col-md-4">
                                    <h5 class="studentName"></h5>
                                </div>
                              </div>

                              <div class="item form-group hidden-div">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class :
                                </label>
                                <div class="col-md-4">
                                    <h5 class="studentClass"></h5>

                                </div>
                              </div>

                              <div class="item form-group hidden-div">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Deposit Balance :
                                </label>
                                <div class="col-md-4">
                                    <h5 class="saldoDeposit"></h5>
                                </div>
                              </div>

                              <div class="item form-group hidden-div">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Grand Total :
                                </label>
                                <div class="col-md-4">
                                    <h5 class="grandTotal"></h5>
                                </div>
                              </div>
                          </form>

                      </div>
               </div>
               <div class="ln_solid"></div>

               <div class="form-group">
                   <div class="col-md-6 col-md-offset-4">
                       <button id="submit" type="button" onClick="process()" class="btn btn-primary">Process</button>
                   </div>
               </div>
            </div>
        </fieldset>
    </div>

  </div>
</div>
