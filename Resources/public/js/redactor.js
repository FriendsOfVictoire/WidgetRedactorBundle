
function initRedactor(item_id, buttons, plugins, lang, autoresize){
    //Default values
    buttons     = typeof buttons !== 'undefined' ? buttons : ['html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|', 'unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 'image', 'video', 'file', 'table', 'link', '|', '|', 'alignment', '|', 'horizontalrule'];
    // plugins     = typeof plugins !== 'undefined' ? plugins : ['media', 'clips', 'fontcolor', 'fontfamily', 'fontsize', 'fullscreen'];
    plugins     = typeof plugins !== 'undefined' ? plugins : ['media', 'clips', 'fontcolor', 'fontfamily', 'fontsize', 'fullscreen'];
    lang        = typeof lang !== 'undefined' ? lang : 'fr';
    autoresize  = typeof autoresize !== 'undefined' ? autoresize : true;

    $vic(item_id).redactor({
        lang: lang,
        autoresize: autoresize,
        buttons: buttons,
        plugins: plugins,
        convertDivs: false,
        paragraphy: false,
        buttonsCustom: {
            image: {
                title: 'Image',
                callback: function(buttonName, buttonDOM, buttonObject) {

                    openDGDialog(Routing.generate('VictoireMediaBundle_chooser'), 1050, 600, function(param){
                        html = '<p><img id="media-' + dialogWin.returnedValue.id + '" src="' + dialogWin.returnedValue.imgpath + '" /></p>';
                        $vic(item_id).redactor('getObject').insertHtml(html);
                    });
                }
            }
        },

    });
}
