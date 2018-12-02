function getMenuParent (level) {
    LIBS._showLoading('loading data ...');
    var url         = $('#ajaxGetParent').val();
    var args        = { type: 'POST', url: url };
    var data        = { level: level };
    var prevLevel   = $('#prevLevel').val();
    var menuId      = $('#id').val();

    LIBS._isAjax(args, data).done( function(resp) {
        $('#menuOrder').empty();
        $('#menuParent').empty();
        if(level == 1){
            $('.hidden-div').hide(9);
            $('.icon-div').show();
            getOrder();
        }

        $.each(resp, function (index, val) {
            $('.icon-div').hide();
            $('.hidden-div').show();

            if (level == 2) {
                if (prevLevel == level - 1 && menuId == val.mlv1_id) {
                    var option = null;
                } else {
                    var option = new Option(val.mlv1_name, val.mlv1_id, false, false);
                }
            } else if (level == 3) {
                if (prevLevel == level - 1 && menuId == val.mlv2_id) {
                    var option = null;
                } else {
                    var option = new Option(val.mlv2_name, val.mlv2_id, false, false);
                }
            }

            $('#menuParent').append(option);
        });
        getOrder();

        LIBS._hideLoading();
    });
}

function getOrder() {
    var url       = $('#ajaxGetOrder').val();
    var level     = $('#menuLevel').val() === '' ? 1 : $('#menuLevel').val() ;
    var parent    = $('#menuParent').val();
    var prevLevel = $('#prevLevel').val();
    var prevOrder = $('#prevOrder').val();

    var args    = { type: 'POST', url: url };
    var data    = { level: level, parent: parent, prevLevel: prevLevel };

    LIBS._showLoading('loading data ...');

    LIBS._isAjax(args, data).done(function(resp) {
        $('#menuOrder').empty();
        var i = 1;
        if ( prevLevel != level ) resp.count += 1;

        while (i <= resp.count) {
            var option = new Option(i, i, false, false);
            $('#menuOrder').append(option);
            i++;
        }

        if (prevLevel == level) {
            $('#menuOrder').val(prevOrder);
        } else {
            $('#menuOrder option:last').attr('selected', 'selected');
        }

        LIBS._hideLoading();
    });
}

function store() {
    var menuName    = $('#menuName').val();
    var menuLevel   = $('#menuLevel').val();
    var menuOrder   = $('#menuOrder').val();
    var menuIcon    = $('#menuIcon').val();
    var menuUrl     = $('#menuUrl').val();
    var menuParent  = $('#menuParent').val();
    var menuActive  = $('#menuActive:checked').val();
    var url         = $('#ajaxStoreMenu').val();

    var flag = false;

    var validator = {
        1 : { alias: 'Menu Name', name: 'menuName' , type: 'required' },
        2 : { alias: 'Level', name: 'menuLevel', type: 'required' },
        3 : { alias: 'Order', name: 'menuOrder', type: 'required' }
    };


    if (LIBS._validation(validator) == false) {
        var validateLev1 = {
            1: { alias: 'Icon', name: 'menuIcon', type: 'required' }
        }

        if (menuLevel == 1 && LIBS._validation(validateLev1) == false) {
            flag = true;
        } else if (menuLevel != 1) {
            flag = true;
        }
    }

    if (flag == true){
        var data = {
            menuName    : menuName,
            menuLevel   : menuLevel,
            menuOrder   : menuOrder,
            menuIcon    : menuIcon,
            menuUrl     : menuUrl,
            menuParent  : menuParent,
            menuActive  : menuActive
        };
        var args = { type: 'POST', url: url };

        LIBS._showLoading('Processing..');
        LIBS._isAjax(args, data).done(function(resp) {
            if (resp.result === true) {
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
    var menuName    = $('#menuName').val();
    var menuLevel   = $('#menuLevel').val();
    var menuOrder   = $('#menuOrder').val();
    var menuIcon    = $('#menuIcon').val();
    var menuUrl     = $('#menuUrl').val();
    var menuParent  = $('#menuParent').val();
    var menuActive  = $('#menuActive:checked').val();
    var url         = $('#ajaxSaveMenu').val();
    var prevLevel   = $('#prevLevel').val();
    var menuId      = $('#id').val();
    var prevOrder   = $('#prevOrder').val();
    var _method     = $('#_method').val();
    var urlAjaxCheck = $('#ajaxChildMenu').val();

    var flag = false;
    var validator = {
        1 : { alias: 'Menu Name', name: 'menuName' , type: 'required' },
        2 : { alias: 'Level', name: 'menuLevel', type: 'required' },
        3 : { alias: 'Order', name: 'menuOrder', type: 'required' }
    };


    if (LIBS._validation(validator) == false) {
        var validateLev1 = {
            1: { alias: 'Icon', name: 'menuIcon', type: 'required' }
        }

        if (menuLevel == 1 && LIBS._validation(validateLev1) == false) {
            flag = true;
        } else if (menuLevel != 1) {
            flag = true;
        }
    }

    if (flag == true){
        var data = {
            '_method'   : 'PUT',
            menuName    : menuName,
            menuLevel   : menuLevel,
            menuOrder   : menuOrder,
            menuIcon    : menuIcon,
            menuUrl     : menuUrl,
            menuParent  : menuParent,
            menuActive  : menuActive,
            prevLevel   : prevLevel,
            menuId      : menuId,
            prevOrder   : prevOrder
        };
        var args = { type: 'POST', url: url };

        LIBS._showLoading('Processing..');
        LIBS._isAjax(args, data).done(function(resp) {
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

function destroy(id, level) {
    var url  = $('#ajaxDestroyMenu').val();
    var data = {
        id    : id,
        level : level,
    };
    var args = { type: 'POST', url: url };

    LIBS._showLoading('Deleting..');
    LIBS._isAjax(args, data).done(function(resp) {
        if (resp.result == true) {
            LIBS._goToPage(resp.redirect);
            LIBS._notifShow('success', 'Success', resp.message);
        } else if (resp.result == false) {
            LIBS._notifShow('error', 'Error', resp.message);
        }
        LIBS._hideLoading();
    });
}

function doSearch() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("table-menu");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
