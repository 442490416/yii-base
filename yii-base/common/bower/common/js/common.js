//------------------------------------String类扩展--------------------------------------
/**
 * 替换所有
 * @param {RegExp|string} reallyDo
 * @param {string}        replaceWith
 * @param {bool}          ignoreCase     是否忽略大小写
 * @returns {string}
 */
String.prototype.replaceAll = function (reallyDo, replaceWith, ignoreCase) {
    if (!RegExp.prototype.isPrototypeOf(reallyDo)) {
        return this.replace(new RegExp(reallyDo, (ignoreCase ? "gi" : "g")), replaceWith);
    } else {
        return this.replace(reallyDo, replaceWith);
    }
};

/**
 * 将base64encode中的+/替换为-_
 * @returns {string}
 */
String.prototype.urlEncode4Base64 = function(){
    return this.replaceAll('\\+','-').replaceAll('\\/','_');
};

/**
 * 将base64encode中的-_替换为+/,再进行base64decode
 * @returns {string}
 */
String.prototype.urlDecode4Base64 = function(){
    return this.replaceAll('-','+').replaceAll('_','/');
};

//------------------------------------Number类扩展--------------------------------------
/**
 * 浮点数比较
 * @param {Number} number  当number小的时候返回1,相等的时候返回0，其他返回-1
 * @param {int}    scale   0-20之间的数,默认精度为10
 */
Number.prototype.bccom = function (number,scale) {
    scale = scale ? scale : 10;

    var selfValue  = this.toFixed(scale);
    var otherValue = number.toFixed(scale);

    if (selfValue == otherValue) {
        return 0;
    } else if (selfValue > otherValue) {
        return 1;
    }
    return -1;
};

/**
 * 浮点数加法
 * @param {Number} number
 * @param {int}    scale   0-20之间的数,默认精度为10
 * @returns {string}
 */
Number.prototype.bcadd = function (number,scale) {
    scale = scale ? scale : 10;
    var result = this + number;
    return result.toFixed(scale);
};

/**
 * 浮点数减法
 * @param {Number} number
 * @param {int}    scale   0-20之间的数,默认精度为10
 * @returns {string}
 */
Number.prototype.bcsub =function (number,scale) {
    scale = scale ? scale : 10;
    var result = this - number;
    return result.toFixed(scale);
};

/**
 * 浮点数乘法
 * @param {Number} number
 * @param {int}    scale   0-20之间的数,默认精度为10
 * @returns {string}
 */
Number.prototype.bcmulti = function (number,scale) {
    scale = scale ? scale : 10;
    var result = this * number;
    return result.toFixed(scale);
};

/**
 * 浮点数除法
 * @param {Number} number  当number为0的时候返回null
 * @param {int}    scale   0-20之间的数,默认精度为10
 * @returns {string}
 */
Number.prototype.bcdiv = function (number,scale) {
    if (number == 0) {
        return null;
    }
    scale = scale ? scale : 10;
    var result = this / number;
    return result.toFixed(scale);
};

//------------------------------------Date类扩展--------------------------------------
/**
 * 获取当前Unix时间戳
 */
Date.prototype.time=function () {
    return Math.round(this.getTime()/1000);
};

//------------------------------------Jquery扩展--------------------------------------

/**
 * 语言级别封装
 */
(function (obj) {
    /**
     * ltrim
     * @param {string} str
     * @param {string} trimStr
     * @returns {string}
     */
    obj.ltrimString = function (str,trimStr) {
        if (str.length > 0 && trimStr.length >0 && str.length > trimStr.length) {
            if (str.indexOf(trimStr) == 0) {
                str = str.substr(trimStr.length);
                obj.ltrimString(str,trimStr);
            }
        }
        return str;
    };

    /**
     * rtrim
     * @param {string} str
     * @param {string} trimStr
     * @returns {string}
     */
    obj.rtrimString = function (str,trimStr) {
        if (str.length > 0 && trimStr.length > 0 && str.length > trimStr.length) {
            if (str.lastIndexOf(trimStr) == (str.length - trimStr.length)) {
                str = str.substr(0,str.length - trimStr.length);
                obj.rtrimString(str,trimStr);
            }
        }
        return str;
    };

    /**
     * trim
     * @param {string} str
     * @param {string} trimStr
     */
    obj.trimString = function (str,trimStr) {
        str = obj.ltrimString(str,trimStr);
        return obj.rtrimString(str,trimStr);
    };

    /**
     * 是否绑定了某事件
     * @param {Object} jqueryObject
     * @param {string} eventName
     * @returns {*}
     */
    obj.hasEvent = function (jqueryObject,eventName) {
        var objEvt = $._data(jqueryObject[0], 'events');
        return objEvt && objEvt[eventName];
    };

    /**
     * 防止重复提交
     * @type {{}}
     */
    obj.block = {};

    /**
     * 成功
     * @type {string}
     */
    obj.SUCCESS = '20000';

    /**
     * 没有权限
     * @type {string}
     */
    obj.FORBIDDEN = '40001';

    /**
     * 通用ajax
     * @param data
     */
    obj.comAjax = function (data) {
        if( obj.block[ data.url ] ) {
            return;
        }

        obj.block[ data.url ] = 1;

        var successCallback = data.success;
        var errorCallback   = data.error ? data.error : function (err) {
            delete obj.block[ data.url ];
        };

        var params = {
            type     :   'post',
            timeout  :   6000,
            dataType :   'json'
        };

        //通用成功回调
        data.success = function (response) {
            delete obj.block[ data.url ];
            successCallback(response);
        };

        //通用异常回调
        data.error = function (err) {
            delete obj.block[ data.url ];
            errorCallback(err);
        };

        params = $.extend(true,params,data);

        if(params.type.toLowerCase() == 'post') {
            var param = $("head meta[name='csrf-param']");
            var token = $("head meta[name='csrf-token']");
            if (param.length > 0 && token.length > 0) {
                params.data[param.attr('content')] = token.attr('content');
            }
        }

        $.ajax(params);
    };

    /**
     * 本地存储
     * @type {{}}
     */
    obj.cache={
        /**
         * 设置本地缓存
         * @param {string} key     键
         * @param {object|string}  value  值
         * @param {int}            expire 过期时间，单位秒，默认是0，0表示永不过期
         */
        set:function (key,value,expire) {
            if (this.check()) {
                expire=expire?expire:0;
                localStorage[key]=JSON.stringify({
                    value:value,
                    time:(new Date()).time(),
                    expire:expire
                });
            }
        },
        /**
         * 获取本地缓存
         * @param {string} key  键
         * @returns {*}
         */
        get:function (key) {
            if (this.check()) {
                if (typeof localStorage[key] == 'string') {
                    var data=JSON.parse(localStorage[key]);
                    if (data.expire == 0 || ( (new Date()).time()-data.time) < data.expire) {
                        return data.value;
                    }
                    this.del(key);
                }
            }
            return false;
        },
        /**
         * 删除本地缓存
         * @param {string} key   键
         */
        del:function (key) {
            if (this.check()) {
                if (typeof localStorage[key] == 'string') {
                    delete localStorage[key];
                }
            }
        },
        /**
         * 检测是否支持本地存储
         * @returns {boolean}
         */
        check:function () {
            if (typeof localStorage == 'object') {
                return true;
            }
            return false;
        }
    };
}($));

/**
 * 初始化页面
 */
$(document).ready(function(){
    if(Page && (typeof Page.init == 'function') ) {
        Page.init();
    }
});