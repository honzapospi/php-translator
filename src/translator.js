var Translator = function (dict, lang) {
    this.dictionary = dict;
    this.lang = lang;
}

Translator.prototype.translate = function (msg, count) {
    return this.translateTo(msg, this.lang);
}

Translator.prototype.translateTo = function (msg, lang) {
    if(!msg)
        throw new Error('Message to translate can not be empty.');
    if(msg.substr(0, 3) != 'tr_')
        return msg;
    if(!this.dictionary[msg]){
        console.log('Missing translation for '+msg+' in '+lang);
        return msg;
    }
    return this.dictionary[msg][lang];
}

var JP = JP || {};
JP.translator = new Translator(dictionary, LANG);
JP.LANG = LANG;