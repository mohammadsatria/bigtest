<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
          <div class="profile_img">
            <div id="crop-avatar">
              <!-- Current avatar -->
              <img class="img-responsive avatar-view" src="{{ !empty($row->std_img) ? asset('uploads/student/'. $row->std_ctr. '.' .$row->std_img ) : asset('images/student-photo.png') }}" alt="Avatar" >
            </div>
          </div>
          <br />

        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="col-md-12">
              <table class="table table-striped">
                  <tr>
                      <td width="30%">Student ID</td>
                      <td width="3%">:</td>
                      <td>{{ $row->std_id }}</td>
                  </tr>

                  <tr>
                      <td>Name</td>
                      <td>:</td>
                      <td>{{ $row->std_name }}</td>
                  </tr>

                  <tr>
                      <td>Gender</td>
                      <td>:</td>
                      <td>{{ $row->std_gender == 0 ? 'Male' : 'Female' }}</td>
                  </tr>

                  <tr>
                      <td>Birth Date</td>
                      <td>:</td>
                      <td>{{ $row->std_birthplace . ', '. dateFormat($row->std_birthdate, 'Y-m-d', 'd F Y') }}</td>
                  </tr>

                  <tr>
                      <td>Class</td>
                      <td>:</td>
                      <td>{{ $row->classes->cls_name }}</td>
                  </tr>

                  <tr>
                      <td>Address</td>
                      <td>:</td>
                      <td>{{ $row->std_address }}</td>
                  </tr>

                  <tr>
                      <td>Barcode ID</td>
                      <td>:</td>
                      <td>{{ $row->std_barcode_id }}</td>
                  </tr>
              </table>
          </div>
          </div>
        </div>
      </div>
    </div>
