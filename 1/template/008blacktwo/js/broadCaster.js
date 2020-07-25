;(function (factory) {
    if (typeof define === "function" && define.amd) {
        define('broadcaster', ['zepto'], function ($) {
            $.fn.broadCaster = factory;
        })
    } else {
        if ($) {
            $.fn.broadCaster = factory;
        }
    }
})(function (param) {
    var settings = {
        intervalGo: null,
        time: 1500,
        index: 0,
        broadPause: true,
        allPause: false,
        pageNote: true
    },
        preSave = {
            broadList: this.find('.broad_item'),
            casterList: this.find('.caster_item') ? this.find('.caster_item') : null,
            pageNote: null,
            next: this.find('.next') ? this.find('.next') : null,
            prev: this.find('.prev') ? this.find('.prev') : null,
        },
        self = this,
        interval = function () {
            if (settings.index >= preSave.broadList.length - 1) {
                settings.index = 0;
            } else {
                settings.index++
            }
            self.trigger('goFade');
        };

    self.on('goFade', function () {
        preSave.broadList.eq(settings.index - 1).removeClass("active");
        preSave.broadList.eq(settings.index).addClass("active");
        if (preSave.casterList.eq(settings.index) && preSave.casterList) {
            preSave.casterList.eq(settings.index - 1).removeClass("active");
            preSave.casterList.eq(settings.index).addClass("active");
        }
        if (preSave.pageNote && preSave.pageNote.eq(settings.index)) {
            preSave.pageNote.eq(settings.index - 1).removeClass("active");
            preSave.pageNote.eq(settings.index).addClass("active");
        }
        if (settings.callBack) {
            settings.callBack(preSave, settings.index);
        }
    });

    self.on('play', function (e) {
        settings.intervalGo = setInterval(interval, settings.time);
    });

    self.on('paulse', function (e) {
        clearInterval(settings.intervalGo);
    });

    if (param) {
        $.extend(settings, param);
    }

    if (settings.pageNote) {
        var Html = '<ul class="pagenote">';
        for (var i = 0; i < preSave.broadList.length; i++) {
            Html += '<li class="pagenote-item"></li>';
        }
        Html += '</ul>';
        self.append(Html);
        preSave.pageNote = self.find('.pagenote-item');
        preSave.pageNote.mouseenter(function(){
            self.trigger('paulse');
            preSave.broadList.eq(settings.index).removeClass("active");
            if (preSave.casterList.eq(settings.index) && preSave.casterList) {
                preSave.casterList.eq(settings.index).removeClass("active");
            }
            if (preSave.pageNote && preSave.pageNote.eq(settings.index)) {
                preSave.pageNote.eq(settings.index).removeClass("active");
            }
            settings.index=$(this).index();
            self.trigger('goFade');
        })
        preSave.pageNote.mouseleave(function(){
            self.trigger('play');
        })
    }

    if (settings.preCall) {
        settings.preCall(preSave);
    }

    preSave.broadList.eq(settings.index).addClass("active");
    if (preSave.casterList) {
        preSave.casterList.eq(settings.index).addClass("active");
    }
    if (preSave.pageNote) {
        preSave.pageNote.eq(settings.index).addClass("active");
    }

    self.trigger('play');

    if (settings.allPause) {
        settings.broadPause = false;
        self.mouseenter(function () {
            self.trigger('paulse');
        });
        self.mouseleave(function () {
            self.trigger('play');
        });
    }

    if (settings.broadPause && self.find(".broad")) {
        self.find(".broad").mouseenter(function () {
            self.trigger('paulse');
        });
        self.find(".broad").mouseleave(function () {
            self.trigger('play');
        });
    }

    if (preSave.next) {
        preSave.next.click(function () {
            self.trigger('paulse');
            if (settings.index >= preSave.broadList.length - 1) {
                settings.index = 0;
            } else {
                settings.index++
            }
            self.trigger('goFade');
            self.trigger('play');
        })
    }

    if (preSave.prev) {
        preSave.prev.click(function () {
            self.trigger('paulse');
            preSave.broadList.eq(settings.index).removeClass("active");
            if (preSave.casterList && preSave.casterList.eq(settings.index)) {
                preSave.casterList.eq(settings.index).removeClass("active");
            }
            if (preSave.pageNote && preSave.pageNote.eq(settings.index)) {
                preSave.pageNote.eq(settings.index).removeClass("active");
            }
            if (settings.index <= 0) {
                settings.index = preSave.broadList.length - 1;
            } else {
                settings.index--;
            }
            self.trigger('goFade');
            self.trigger('play');
        })
    };

    if(self.swipeLeft){
        self.swipeLeft(function () {
            self.trigger('paulse');
            if (settings.index >= preSave.broadList.length - 1) {
                settings.index = 0;
            } else {
                settings.index++
            }
            self.trigger('goFade');
            self.trigger('play');
        })
    }
    
    if(self.swipeRight){
        self.swipeRight(function () {
            self.trigger('paulse');
            preSave.broadList.eq(settings.index).removeClass("active");
            if (preSave.casterList && preSave.casterList.eq(settings.index)) {
                preSave.casterList.eq(settings.index).removeClass("active");
            }
            if (preSave.pageNote && preSave.pageNote.eq(settings.index)) {
                preSave.pageNote.eq(settings.index).removeClass("active");
            }
            if (settings.index <= 0) {
                settings.index = preSave.broadList.length - 1;
            } else {
                settings.index--;
            }
            self.trigger('goFade');
            self.trigger('play');
        })
    }
   
});