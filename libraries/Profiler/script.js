var Profiler = new Class({
    initialize: function(profilerId, classToHide) {
        this.current        = null;
        this.profilerId     = profilerId;
        this.classToHide    = classToHide;

        this._hideClass();
    },

    show: function(obj, el) {
        var self = this;

        if (obj == self.current) {
            new Fx.Slide(obj).slideOut();
            self.current = null;
        } else {
            if (self.current) new Fx.Slide(self.current).slideOut();
            new Fx.Slide(obj).slideIn();
            if (self.current) $(self.current).removeClass('current');
            self.current = obj;
        }
    },

    close: function() {
        var self = this;

        $(self.profilerId).setStyle('display', 'none');
    },

    toggleVisibility: function() {
        var self = this;

        $(self.profilerId).setStyle('display', (('none' == $(self.profilerId).getStyle('display')) ? '' : 'none'));
    },

    _hideClass: function() {
        var self = this;

        $$(self.classToHide).each(function(el){
            new Fx.Slide(el).hide();
        });
    },
});

var profiler_bar = new Profiler('profiler', '.profiler-box');

window.addEvent('keydown', function(evt) {
    if(evt.key == 'p' && evt.shift) {
        profiler_bar.toggleVisibility();
    }
});