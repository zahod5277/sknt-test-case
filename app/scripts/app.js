var App = {

    options: {
        groupSelector: '[data-select="group"]',
        tarifsContainer: '.tarifs',
        tarifsContainerVisibleClass: 'tarifs--visible'
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
                    $(App.options.tarifsContainer).html(resp);
                    $('html, body').css({
                        overflow: 'hidden',
                        height: '100%'
                    });
                    $(App.options.tarifsContainer).addClass(App.options.tarifsContainerVisibleClass);
                });
    })
    App.init();
});