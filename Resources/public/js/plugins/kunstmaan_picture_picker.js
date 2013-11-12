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
