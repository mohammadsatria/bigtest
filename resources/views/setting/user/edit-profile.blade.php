<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h4>{{ $subTitle }}</h4>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form class="form-horizontal form-label-left" name="userForm" id="userForm" data-parsley-validate="">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <input type="text" value="{{ $data->name }}" id="name" name="name" class="form-control col-md-4" maxlength="50" />
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <input type="email" value="{{ $data->email }}" id="email" name="email" class="form-control col-md-4" maxlength="50" />
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
              </label>
              <div class="col-md-4">
                <input type="text" value="{{ $data->username }}" id="username" name="username" class="form-control col-md-4" maxlength="10" />
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password
              </label>
              <div class="col-md-4">
                <input type="password" id="password" name="password" class="form-control col-md-4" maxlength="35" />
                <br>
                <br>
                <span class="label label-warning">*fill this password if password will be changed</span>
              </div>
            </div>


          <div class="item form-group hidden-div">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="depositStatus">Usertype <span class="required">*</span>
            </label>
            <div class="col-md-4">

                <select id="usertypeId" name="usertypeId" class="form-control">
                  <option value=""></option>
                  @foreach ($usertype as $key => $val)
                      <option {{ $val->ust_id == $data->ust_id ? 'selected' : '' }} value="{{ $val->ust_id }}">{{ $val->ust_name }}</option>
                  @endforeach
                </select>
            </div>
          </div>

          {{-- image --}}
          {{-- <div class="item form-group">
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
                           <input type="file" accept="image/png, image/jpeg, image/gif" onchange="readURL(this)" id="userImage" name="input-file-preview"/> <!-- rename it -->
                       </div>
                   </span>
                </div>
                @if (empty($data->img))
                    <img id="img" src="{{ asset('images/admin-default.png') }}" alt="..." class="img-circle preview-profile_img">
                @else
                    <img id="img" src="{{ asset('uploads/user/'. $data->id. '.'. $data->img ) }}" alt="..." class="img-circle preview-profile_img">
                @endif
                    <input type="hidden" name="urlDefault" id="urlDefault" value="{{ asset('images/admin-default.png') }}">
              </div>
          </div> --}}

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                {{-- hidden text --}}
              <input type="hidden" id="id" name="id" value="{{ $data->id }}" />
              <input type="hidden" id="status" name="status" value="editProfile" />

              <button type="button" onClick="LIBS._goToPage('{{ route('user-profile') }}')" class="btn btn-dark">Cancel</button>
              <button id="submit" type="button" onClick="save()" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
