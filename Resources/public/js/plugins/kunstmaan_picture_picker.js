if (typeof RedactorPlugins === 'undefined') var RedactorPlugins = {};

RedactorPlugins.media = {
    imageEdit: function(img)
    {
        var id = $vic(img).attr('id').replace('media-', '');

        openDGDialog(Routing.generate('VictoireMediaBundle_chooser', { mediaId: id, _locale: locale }), 1050, 600, function(param){
            $vic(img).attr('src', dialogWin.returnedValue.imgpath);
        });
    }
}
