JP.translator.onTranslate(function(translator, msg, lang){
    if(!msg)
        return;
    if(msg.substr(0, 3) != 'tr_')
        return msg;
    if(!translator.dictionary[msg]){
        if(!JP.LINK_ADD_TRANSLATION)
            alert('Link to add translation is missing.');
        $.get(JP.LINK_ADD_TRANSLATION, {addToDictionary: msg});
    }
})