<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h4>Application Setting </h4>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
          <table class="table">
              <tr>
                  <td width="20%"><strong>{{ $data[0]->info }}</strong></td>
                  <td width="5%">:</td>
                  <td>
                      <input type="text" class="form-control right-align" style="width:150px;" onkeypress="LIBS._isCurrency(this.id)" value="{{ numberFormat($data[0]->value) }}" name="deposit-minimum" id="deposit-minimum">
                  </td>
              </tr>

              <tr>
                  <td width="20%"><strong>{{ $data[1]->info }}</strong></td>
                  <td width="5%">:</td>
                  <td>
                      <input type="text" class="form-control right-align" style="width:150px;" onkeypress="LIBS._isCurrency(this.id)" value="{{ numberFormat($data[1]->value) }}" name="limit-transaction" id="limit-transaction">
                  </td>
              </tr>

              <tr>
                  <td colspan="3">
                      <button id="submit" type="button" onClick="save()" class="btn btn-primary">Save Changes</button>
                  </td>
              </tr>
          </table>
      </div>
    </div>
  </div>
</div>
