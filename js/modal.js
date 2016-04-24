$(document).ready(function() {
    //Open Modal.
    $(document).on('click', '.open-modal', function(e){
        $('body').append('<div class="dim-background" />');
        $(e.target).parent().append('<div class="modal" />');

        //load modal with correct form(by id)
        $('.modal').load("includes/forms/" + e.target.id + '.php');

        //Get AJAX scripts for forms
        $.getScript('js/form_submit.js');

        //Close button on modal.
        $('.modal').on('click', '.close-modal', function(e){
            $('.dim-background').remove();
            $('.modal').remove();
        });

        //Click outside of div.
        $('.dim-background').click(function(e){
            $('.dim-background').remove();
            $('.modal').remove();
        });
    });
});
