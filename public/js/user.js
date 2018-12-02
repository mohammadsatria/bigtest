function store() {
    var url        = $('#ajaxStore').val();
    var username   = $('#username').val();
    var password   = $('#password').val();
    var usertypeId = $('#usertypeId').val();
    var name       = $('#name').val();
    var email      = $('#email').val();

    var validator = {
        1 : { alias: 'Name', name: 'name' , type: 'required' },
        2 : { alias: 'Email', name: 'email' , type: 'required' },
        3 : { alias: 'Username', name: 'username' , type: 'required' },
        4 : { alias: 'Password', name: 'password' , type: 'required' },
        5 : { alias: 'Usertype', name: 'usertypeId' , type: 'required' }
    };

    if (LIBS._validation(validator) == false) {
        var fileData = $('#userImage').prop('files')[0];

        var data = {
            username  : username,
            password  : password,
            usertypeId: usertypeId,
            name      : name,
            email     : email
        };
        var args = { type: 'POST', url: url };

        LIBS._showLoading('Processing..');
        LIBS._isAjax(args, data).done(function (resp) {
            if (resp.result == true) {
                if (fileData !== 'undefined') {
                    var formData = new FormData();
                    args.url     = $('#ajaxUploadImageUser').val();

                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    formData.append('file', fileData);
                    formData.append('id', resp.id);

                    LIBS._uploadAjax(args, formData).done();
                }
                LIBS._goToPage(resp.redirect);
                LIBS._notifShow('success', 'Success', resp.message);
            } else if (resp.result == false) {
                LIBS._notifShow('error', 'Error', resp.message);
            }
            LIBS._hideLoading();
        });
    }
}

function save() {
    var url        = $('#ajaxSave').val();
    var username   = $('#username').val();
    var password   = $('#password').val();
    var usertypeId = $('#usertypeId').val();
    var name       = $('#name').val();
    var email      = $('#email').val();
    var id         = $('#id').val();
    var status     = $('#status').val();

    var validator = {
        1 : { alias: 'Name', name: 'name' , type: 'required' },
        2 : { alias: 'Email', name: 'email' , type: 'required' },
        3 : { alias: 'Username', name: 'username' , type: 'required' },
        4 : { alias: 'Usertype', name: 'usertypeId' , type: 'required' }
    };

    if (LIBS._validation(validator) == false) {
        var fileData = $('#userImage').prop('files')[0];
        var data = {
            '_method' : 'PUT',
            username  : username,
            password  : password,
            usertypeId: usertypeId,
            name      : name,
            email     : email,
            id        : id,
            status    : status
        };
        var args = { type: 'POST', url: url };

        LIBS._showLoading('Processing..');
        LIBS._isAjax(args, data).done(function (resp) {
            if (resp.result == true) {
                if (fileData !== 'undefined') {
                    var formData = new FormData();
                    args.url     = $('#ajaxUploadImageUser').val();

                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    formData.append('file', fileData);
                    formData.append('id', resp.id);

                    LIBS._uploadAjax(args, formData).done();
                }
                LIBS._goToPage(resp.redirect);
                LIBS._notifShow('success', 'Success', resp.message);
            } else if (resp.result == false) {
                LIBS._notifShow('error', 'Error', resp.message);
            }
            LIBS._hideLoading();
        });
    }
}

function destroy(id) {
    var url  = $('#ajaxDestroy').val();
    var data = { id: id };
    var args = { type: 'POST', url: url };

    LIBS._showLoading('Deleting ..');
    LIBS._isAjax(args, data).done(function (resp) {
        if (resp.result == true) {
            LIBS._goToPage(resp.redirect);
            LIBS._notifShow('success', 'Success', resp.message);
        } else if (resp.result == false) {
            LIBS._notifShow('error', 'Error', resp.message);
        }
        LIBS._hideLoading();
    });
}

function readURL(input) {
  var file = input.files[0];
  var reader = new FileReader();
  // Set preview image into the popover data-content
  reader.onload = function (e) {
      $(".image-preview-input-title").text("Change");
      $(".image-preview-clear").show();
      $(".image-preview-filename").val(file.name);
      $('#img').show();
      $('#img').attr('src', e.target.result);

  }
  reader.readAsDataURL(file);
}

function clearUrl() {
    var urlDefault = $('#urlDefault').val();
    $('.image-preview').attr("data-content","").popover('hide');
    $('.image-preview-filename').val("");
    $('.image-preview-clear').hide();
    $('.image-preview-input input:file').val("");
    $(".image-preview-input-title").text("Browse");
    $('#img').attr('src', urlDefault);
    $('#img').hide();
}
