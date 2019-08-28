var App = {

    options: {
        screen: ['group', 'GetTarifs', 'GetTarif']
    },

    init: function () {
        
    },
    screenBackward: function (current) {
        console.log('[data-select-parent="'+App.options.screen[App.options.screen.indexOf(current)]+'"]');
        $('[data-select-parent="'+App.options.screen[App.options.screen.indexOf(current)+1]+'"]').hide();
        $('[data-select-parent="'+App.options.screen[App.options.screen.indexOf(current)]+'"]').show();
    },
    screenForward: function (current) {
        $('[data-select-parent="'+App.options.screen[App.options.screen.indexOf(current)-1]+'"]').hide();
        $('[data-select-parent="'+App.options.screen[App.options.screen.indexOf(current)]+'"]').show();
    }
}

$(document).ready(function () {
    $('body').on('click', '[data-select]', function (e) {
        e.preventDefault();
        var group = $(this).data('group'),
                action = $(this).data('action'),
                id = $(this).data('id');
        $.post(
            'index.php', {
                q: action,
                group: group,
                id: id
            },
            function (resp) {
                console.log(App.options.screen[App.options.screen.indexOf(action)-1]);
                $('[data-select-parent="'+action+'"]').html(resp);
                App.screenForward(action);
            });
    });
    $('body').on('click', '[data-backward]', function(e){
       e.preventDefault();
       App.screenBackward($(this).data('backward'));
    });
});