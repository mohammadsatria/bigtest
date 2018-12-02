    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>{{ $subTitle }}</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="img-responsive avatar-view" src="{{ !empty(Auth::user()->img) ? asset('uploads/user/'. Auth::id(). '.'. Auth::user()->img) : asset('images/user.png') }}" alt="Avatar" >
                </div>
              </div>
              <h3>{{ Auth::user()->name }}</h3>

              <a href="{{ route('user-edit-profile') }}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
              <br />

            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">

              <div class="profile_title">
                <div class="col-md-6">
                  <h2>Detail User</h2>
                </div>
              </div>
              <table class="table table-striped">
                  <tr>
                      <td>Name</td>
                      <td>:</td>
                      <td>{{ Auth::user()->name }}</td>
                  </tr>
                  <tr>
                      <td>Username</td>
                      <td>:</td>
                      <td>{{ Auth::user()->username }}</td>
                  </tr>
                  <tr>
                      <td>Password</td>
                      <td>:</td>
                      <td>********</td>
                  </tr>
                  <tr>
                      <td>Usertype</td>
                      <td>:</td>
                      <td>{{ $user->usertype->ust_name }}</td>
                  </tr>
                  <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td>{{ Auth::user()->email }}</td>
                  </tr>
              </table>

              </div>
            </div>
          </div>
        </div>
