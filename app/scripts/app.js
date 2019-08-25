var App = {

    options: {
        groupSelector: '[data-select="group"]'
    },

    init: function () {

    },
    tarifGroupSelect: function () {

    }
}

$(document).ready(function () {
    $('body').on('click', App.options.groupSelector, function (e) {
        e.preventDefault();
        var group = $(this).data('group');
        $.post(
                'index.php', {
                    q: 'GetTarifs',
                    group: group,
                },
                function (resp) {
                    console.log(resp)
                });
    })
    App.init();
});