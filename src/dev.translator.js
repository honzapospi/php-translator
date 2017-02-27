JP.translator.onTranslate(function(translator, msg, lang){
    if(!msg)
        return;
    if(msg.substr(0, 3) != 'tr_')
        return msg;
    if(!translator.dictionary[msg]){
        if(!LINK_ADD_TRANSLATION)
            alert('Link to add translation is missing.');
        $.get(LINK_ADD_TRANSLATION+msg, function (response, status) {

        });
    }
})