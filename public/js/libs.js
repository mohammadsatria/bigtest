LIBS = {
    _goToPage: function(url, functionName = null){
        LIBS._showLoading('Please wait ...');
        $.ajax({
            type: 'GET',
            url: url,
        }).done(
            function(data){
                $('#content-data').html(data);
                $('#datatable').DataTable();

                if (functionName != null ) {
                    eval(functionName + "()");
                }

                LIBS._hideLoading();
           }
       );
    },
    _modal: function(args){
        var idModal = $('#modal-medium');
        idModal.find('.modal-title').html(args.title);
        idModal.find('.modal-body').html(args.body);

        idModal.modal('show');
    },
    _showLoading: function(message){
        $('.loading-message').html(message);
        $('#loader').show(5);
    },
    _hideLoading: function(){
        $('#loader').hide(5);
    },
    _notifShow: function(type, title, message){
        PNotify.removeAll();
        new PNotify({
            title: title,
            text:  message,
            type:  type,
            styling: 'bootstrap3',
            delay: 1500
        });
    },
    _isCurrency: function(id)  {
        new Cleave('#' + id, {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.'
        });

    },
    _isNumber: function(id) {
        new Cleave('#' + id, {
            numeral: true,
            numeralThousandsGroupStyle: 'none'
        });
    },
    _validation: function(args) {
        var flag = false;
        $.each(args, function(index, value) {
            if (value.type == 'required') {
                if ($('#' + value.name).val() == '') {
                    LIBS._notifShow('warning', 'Required', 'Please fill ' + value.alias);
                    $('#' + value.name).focus();
                    flag = true;
                    return false;
                }
            }
        });
        return flag;
    },
    _isAjax: function(args, data) {
        if (args.type == 'POST') {
            data._token = $('meta[name="csrf-token"]').attr('content');
        }

        return $.ajax({
            type       : args.type,
            url        : args.url,
            dataType   : 'json',
            data       : data
        });
    },
    _uploadAjax: function(args, data) {
        return $.ajax({
            type       : args.type,
            url        : args.url,
            dataType   : 'json',
            data       : data,
            processData: false,
            contentType: false
        });
    },
    _isDatepicker: function(id) {
        $('#' + id).datetimepicker({
            format: 'DD/MM/YYYY'
        });
    },
    _inputDate: function(id) {
        new Cleave('#' + id, {
            date: true,
            datePattern: ['d', 'm', 'Y']
        });
    },
    _numberFormat: function(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
}
