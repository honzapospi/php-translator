var Translator = function (dict, lang) {
    this.dictionary = dict;
    this.lang = lang;
}

Translator.prototype.translate = function (msg, count) {
    if(!msg)
        throw new Error('Message to translate can not be empty.');
    if(!this.dictionary[msg])
        return msg;
    return this.dictionary[msg][this.lang];
}

Translator.prototype.translateTo = function (msg, lang) {
    if(!msg)
        throw new Error('Message to translate can not be empty.');
    if(!this.dictionary[msg])
        return msg;
    return this.dictionary[msg][lang];
}

var JP = JP || {};
JP.translator = new Translator(dictionary, LANG);
JP.LANG = LANG;