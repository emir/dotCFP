/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('raty-js/lib/jquery.raty');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//User Detail Modal
$("#userModal").on("show.bs.modal", function (e) {
    var link = $(e.relatedTarget);

    $(this).find(".modal-body").load(link.attr("href"));
});

//Talk Vote
$('#rate').raty({
    click: function (score, evt) {
        var url = $(this).data('href');

        $.ajax({
            url: url,
            type: "POST",
            data: {"vote": score},
            dataType: 'json',
            success: function (response) {
                $('#rate').raty('score', response.vote);

                bootbox.alert("Voted. Thank you!");
            },
            error: function (error) {
                bootbox.alert("An error encountered performing the requested operation");
            }
        });
    },
    starType: 'i'
});

$(document).on('submit', '#role', function (e) {
    var role = $(this).find('select[name="role"]').val();

    var url = $(this).attr('action');

    console.log(role, url);

    $.ajax({
        url: url,
        type: "POST",
        data: {"role": role},
        dataType: 'json',
        success: function (response) {
            bootbox.alert("Role successfully assigned to user");
        },
        error: function (error) {
            bootbox.alert("An error encountered performing the requested operation");
        }
    });

    e.preventDefault();
});

$('#flash-overlay-modal').modal();
