var skeletonId = 'skeleton';
var contentId = 'content';
var skipCounter = 0;
var takeAmount = 10;

function getCounts() {
    api('/connections/counts', 'GET', (response) => {
        $('#get_suggestions_btn').find('span').html(response.suggestions);
        $('#get_sent_requests_btn').find('span').html(response.sent_requests);
        $('#get_received_requests_btn').find('span').html(response.received_requests);
        $('#get_connections_btn').find('span').html(response.connections);
    });
}

function getSuggestions() {
    var query = makeQuery({
        page: $('#load_more_btn_parent').data('page'),
        per_page: 10,
        type: 'suggestions',
        user_id: 1
    });

    api('/connections' + query, 'GET', (response) => {
        if (response.page !== 2) {
            $('#content').append(response.content);
        } else {
            $('#content').empty().html(response.content);
        }
        $('#load_more_btn_parent').data('page', response.page);
    });
}

function getRequests(mode) {
    var query = makeQuery({
        page: $('#load_more_btn_parent').data('page'),
        per_page: 10,
        type: mode === 'sent' ? 'sent_requests' : 'received_requests',
        user_id: 1
    });

    api('/connections' + query, 'GET', (response) => {
        if (response.page !== 2) {
            $('#content').append(response.content);
        } else {
            $('#content').empty().html(response.content);
        }
        $('#load_more_btn_parent').data('page', response.page);
    });
}

function getConnections() {
    var query = makeQuery({
        page: $('#load_more_btn_parent').data('page'),
        per_page: 10,
        type: 'connections',
        user_id: 1
    });

    api('/connections' + query, 'GET', (response) => {
        if (response.page !== 2) {
            $('#content').append(response.content);
        } else {
            $('#content').html(response.content);
        }
        $('#load_more_btn_parent').data('page', response.page);
    });
}

function getMoreRequests(mode) {
    // Optional: Depends on how you handle the "Load more"-Functionality
    // your code here...
}

function getMoreConnections() {
    // Optional: Depends on how you handle the "Load more"-Functionality
    // your code here...
}

function getConnectionsInCommon(userId, connectionId) {

}

function getMoreConnectionsInCommon(userId, connectionId) {
    // Optional: Depends on how you handle the "Load more"-Functionality
    // your code here...
}

function getMoreSuggestions() {
    // Optional: Depends on how you handle the "Load more"-Functionality
    // your code here...
}

function sendRequest(userId) {
    var form = makeForm({
        user_to_id: userId
    });

    api('/connections', 'POST', ({reponse}) => {
        getSuggestions();
        getCounts();
    }, form);
}

function deleteRequest(userId) {
    api('/connections/' + userId, 'DELETE', ({reponse}) => {
        getRequests('sent');
        getCounts();
    });
}

function acceptRequest(userId) {
    api('/connections/' + userId, 'PUT', ({content}) => {
        getRequests();
        getCounts();
    });
}

function removeConnection(userId) {
    api('/connections/' + userId, 'DELETE', ({reponse}) => {
        getConnections();
        getCounts();
    });
}

$(document).ready(function () {
    getCounts();
    getSuggestions();

    $('#btnradio1').click(function () {
        $('#load_more_btn_parent').data('tab', 1).data('page', 1);
        getSuggestions();
    })

    $('#btnradio2').click(function () {
        $('#load_more_btn_parent').data('tab', 2).data('page', 1);
        getRequests('sent');
    })

    $('#btnradio3').click(function () {
        $('#load_more_btn_parent').data('tab', 3).data('page', 1);
        getRequests();
    })

    $('#btnradio4').click(function () {
        $('#load_more_btn_parent').data('tab', 4).data('page', 1);
        getConnections();
    })

    $('#load_more_btn_parent').click(function () {
        var tab = $(this).data('tab');
        if (tab === 1) {
            getSuggestions();
        } else if (tab === 2) {
            getRequests('sent');
        } else if (tab === 3) {
            getRequests();
        } else {
            getConnections();
        }
    });

    $(document).on('click', '.connect-user', function () {
        var user_id = $(this).data('id');
        $('#load_more_btn_parent').data('page', 1);
        sendRequest(user_id);
    })

    $(document).on('click', '.withdraw-request', function () {
        var user_id = $(this).data('id');
        $('#load_more_btn_parent').data('page', 1);
        deleteRequest(user_id);
    })

    $(document).on('click', '.accept', function () {
        var user_id = $(this).data('id');
        $('#load_more_btn_parent').data('page', 1);
        acceptRequest(user_id);
    })

    $(document).on('click', '.remove-connection', function () {
        var user_id = $(this).data('id');
        $('#load_more_btn_parent').data('page', 1);
        removeConnection(user_id);
    })
})
