var skeletonId = 'skeleton';
var contentId = '#content';
var createRequestBtn = '.create_request_btn';
var skipCounter = 0;
var takeAmount = 10;
var fullUrl;

function loadMoreData(){
    $('#load_more_btn').click(function(){
        var pageCount =takeAmount + 10;
        takeAmount =pageCount;
        $.ajax({
            url: fullUrl,
            data:{pageCount: pageCount},
            success: function (data) {
                $(contentId).html(data).hide().slideToggle();
            }
        });
    });
}

function getRequests() {
    $('.get_requests_btn').click(function(){
        var mode = $(this).data('mode');
        url = '/ajax/requests/'+mode,
        fullUrl = window.location.origin+url
        $.ajax({
            url: url,
            data: {pageCount: 5},
            success: function (data) {
                $(contentId).html(data).hide().slideToggle();
            }
        });
    });

}

function getMoreRequests(mode) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnections() {
    $('#get_connections_btn').click(function(){
        getLoader()
        url = '/connections',
        fullUrl = window.location.origin+url
        console.log(fullUrl);
        $.ajax({
            url: url,
            data: {pageCount: 10},
            success: function (data) {
                $(contentId).html(data).hide().slideToggle();
            },
            error: function (data) {
            }
        });
    });
}

function getMoreConnections() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnectionsInCommon(userId, connectionId) {
  // your code here...
}

function getMoreConnectionsInCommon(userId, connectionId) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function initSuggestion(){
    url = '/suggestions',
    fullUrl = window.location.origin+url
    $.ajax({
        url: url,
        data: {pageCount: 5},
        success: function (data) {
            $(contentId).html(data).hide().slideToggle();
        },
        error: function (response,data) {
            if(response.status === 500){
                return "Service Unavailable"
            }else{
                return response.responseText;
            }
        }
    });
}

function getLoader(){
    url = '/loader',
        $.ajax({
            url: url,
            success: function (data) {
                $(contentId).html(data).hide().show();
            }
        });
}

function getSuggestions() {
    $('#get_suggestions_btn').click(function(){
        getLoader();
        initSuggestion();
    });
}

function getMoreSuggestions() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...

}

function sendRequest(){
    $(document).on('click','.create_send_request',function(){
        var suggestionId = $(this).data('suggested-connection-id');
        console.log(suggestionId);
        console.log("running");

        url = '/send/request/'+suggestionId;
        fullUrl = window.location.origin+url
        $.ajax({
            url: url,
            type:'POST',
            data:{'_token': $('meta[name=csrf-token]').attr('content')},
            success: function (data) {
                initSuggestion();
            }
        });
    });
}

function deleteRequest() {
    $(document).on('click','.withdraw_request_btn',function(){
        var requestId = $(this).data('request-id')
        url = 'delete/request/'+requestId;
        $.ajax({
            url: url,
            success: function (data) {
                $(contentId).html(data).hide().slideToggle();
            }
        });
    });

}

function acceptRequest(userId, requestId) {
  // your code here...
}

function removeConnection(userId, connectionId) {
  // your code here...
}


$(function () {
  sendRequest();
  initSuggestion();
  getRequests();
  getSuggestions();
  getConnections();
  loadMoreData();
  deleteRequest();
});
