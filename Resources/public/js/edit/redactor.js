if (typeof RedactorPlugins === 'undefined') var RedactorPlugins = {};

RedactorPlugins.media = {
    imageEdit: function(e)
    {
        var $el = $(e.target);
        var parent = $el.parent();
        var id = $el.attr('id').replace('media-', '');

        openDGDialog(Routing.generate('KunstmaanMediaBundle_media_show', { mediaId: id }), 1050, 600);
    }

}


function initRedactor(item_class){
    buttons = ['html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|',
    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
    'image', 'video', 'file', 'table', 'link', '|', '|', 'alignment', '|', 'horizontalrule'];
    $(item_class).redactor({
        lang: 'fr',
        autoresize: true,
        buttons: buttons,
        plugins: ['media'],
        buttonsCustom: {
            image: {
                title: 'Image',
                callback: function(buttonName, buttonDOM, buttonObject) {

                    openDGDialog(Routing.generate('KunstmaanMediaBundle_chooser'), 1050, 600, function(param){
                        html = '<p><img id="media-' + dialogWin.returnedValue.id + '" src="' + dialogWin.returnedValue.imgpath + '" /></p>';
                        $('.redactor').insertHtml(html);
                    });
                }
            }
        },

    });
}

