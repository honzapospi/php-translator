var Translator = function (dict, lang) {
    this.dictionary = dict;
    this.lang = lang;
}

Translator.prototype.translate = function (msg, count) {
    return this.dictionary[msg][this.lang];
}

Translator.prototype.translateTo = function (msg, lang) {
    return this.dictionary[msg][lang];
}

var JP = JP || {};
JP.translator = new Translator(dictionary, LANG);
JP.LANG = LANG;