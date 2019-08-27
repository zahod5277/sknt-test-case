var App = {

    options: {
        groupSelector: '[data-select="group"]',
        tarifsGroupsContainer: '.tarifs-group',
        tarifsContainer: '.tarifs',
        tarifsContainerVisibleClass: 'tarifs--visible',
        tarifsSelector: '[data-select="tarif"]'
    },

    init: function () {

    },
    screenBackward: function () {

    },
    screenForward: function () {

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
                    $(App.options.tarifsGroupsContainer).hide();
                    $(App.options.tarifsContainer).addClass(App.options.tarifsContainerVisibleClass);
                });
    });
    $('body').on('click', App.options.tarifsSelector, function (e) {
        e.preventDefault();
        var id = $(this).data('id'),
            group = $(this).data('group');
        $.post(
                'index.php', {
                    q: 'GetTarif',
                    id: id,
                    group: group
                },
                function (resp) {
                    console.log(resp);
                });
    });
    App.init();
});