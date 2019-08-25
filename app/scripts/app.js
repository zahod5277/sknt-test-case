var App = {

    options: {
        groupSelector: '[data-select="group"]'
    },

    init: function () {
        
    },
    tarifGroupSelect: function(){
        
    }
}

$(document).ready(function () {
    $('body').on('click', App.options.groupSelector, function(e){
        e.preventDefault();
        console.log('YEP!');
    })
    App.init();
});