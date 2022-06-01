function makeQuery(params) {
    var query = [];
    Object.keys(params).map((name) => {
        query.push(name + '=' + params[name]);
    });
    query = query.length ? '?' + query.join('&') : '';
    return query;
}

function makeForm(params) {
    var form = new FormData();
    Object.keys(params).map((name) => {
        form.append(name ,params[name]);
    });
    return form;
}

function api(url, method, action, data) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    if (typeof data === 'undefined') {
        data = new FormData;
    }

    $.ajax({
        url: url,
        type: method,
        async: true,
        data: data,
        processData: false,
        contentType: false,
        dataType: 'json',
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        },
        success: function(response) {
            action(response);
        }
    });
}
