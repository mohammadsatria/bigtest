function submitMe(){
    var selectedMenu = [];
    var selectedElms = $('#html1').jstree("get_selected", true);
    $.each(selectedElms, function() {
        selectedMenu.push(this.id);
    });
}

function store() {
    var usertypeName = $('#usertypeName').val();
    var url          = $('#ajaxStore').val();

    var validator = {
        1 : { alias: 'User Type', name: 'usertypeName' , type: 'required' }
    };

    if (LIBS._validation(validator) == false) {
        var data = { ust_name : usertypeName };
        var args = { type: 'POST', url: url };

        LIBS._showLoading('Processing..');
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
}

function save() {
    var url          = $('#ajaxSave').val();
    var usertypeName = $('#usertypeName').val();
    var usertypeId   = $('#usertypeId').val();

    var validator = {
        1 : { alias: 'User Type', name: 'usertypeName' , type: 'required' }
    };

    if (LIBS._validation(validator) == false) {
        var data = { '_method': 'PUT', ust_name: usertypeName, ust_id: usertypeId };
        var args = { type: 'POST', url: url };

        LIBS._showLoading('Processing..');
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
}

function destroy(id) {
    var url  = $('#ajaxDestroy').val();
    var data = { ust_id: id };
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

function accessStore() {
    var url        = $('#ajaxStoreUserAccess').val();
    var userAccess = [];

    var selectedElms = $('#html1').jstree("get_checked", true);
    $.each(selectedElms, function() {
        var split = this.id.split('-');
        var level = split[1];
        var id    = split[2];
    
        userAccess.push({
            level : level,
            id    : id,
            status: 'W'
        })
    });


     if (userAccess.length == 0) {
         LIBS._notifShow('error', 'Error', "Please check menu access");
     } else {
         userAccess     = JSON.stringify(userAccess);
         var args       = { type: 'POST', url: url };
         var usertypeId = $('#usertypeId').val();
         var data       = { userAccess: userAccess, usertypeId: usertypeId };
         LIBS._showLoading('Processing ..');
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
}
