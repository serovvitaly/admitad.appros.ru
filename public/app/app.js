function Scarlet(){
    
    var self = this;
    
    this.resultContainer = $('#exp-result-content');
    
    //this.resultLayout = new Backbone.ChildViewContainer();
    
    this.init();
    
}
Scarlet.prototype.init = function(){
    Handlebars.registerHelper('ucfirst', function(str) { 
        var f = str.charAt(0).toUpperCase();
        return f + str.substr(1, str.length-1);
    });
    
    this.products = new CollectionProducts();
    
    // Init Routes
    this.routes = new Backbone.Router();
    this.initRoutes();
    Backbone.history.start();
    
}
Scarlet.prototype.initRoutes = function(){
    
    var self = this;
    
    this.routes.route('prod/:productId(/)', 'product', function(productId){
        if (productId > 0) {
            self.products.getById(productId);
        }
        
        //alert('Продукт не найден');
    });
}
Scarlet.prototype.loadProducts = function(){
    
    var self = this,
        preloader = this.newPreloader();
        
    this.resultContainer.html('');
    this.showPreloader(this.resultContainer, preloader);
    
    this.products.load(function(){
        self.hidePreloader(preloader, function(){
            _.each(self.products.models, function(model, key){
                var view = new  ViewProductMini({model:model});
                view.$el.appendTo(self.resultContainer);
                view.$el.fadeIn();
                //view.$el.find('.image').imgLiquid();                
                view.$el.find('.image').krioImageLoader();                
            }); 
        });
    });
}
Scarlet.prototype.newPreloader = function(){
    return $('<div class="ajax-loader" style="display: none;"></div>');
}
Scarlet.prototype.showPreloader = function(container, preloader){
    preloader.appendTo(container);
    preloader.fadeIn();
}
Scarlet.prototype.hidePreloader = function(preloader, success){
    preloader.fadeOut(null, function(){
        preloader.remove();
        if (success) success();
    });
}
Scarlet.prototype.alert = function(title, message){
    //
}

Backbone.sync = function(method, model, options){
    var collection = this;
    $.ajax($.extend({
        url: '/api/' + model,
        dataType: 'json'
    }, options));
}
 
var ModelProduct = Backbone.Model.extend({
    //
});

var CollectionProducts = Backbone.Collection.extend({
    model: ModelProduct,
    getById: function(id){
        var self = this;
        if (this.length < 1 || !this.get(id)) {
            this.sync('read', 'product', {
                data: {
                    pid: id
                },
                success: function(data){                
                    if (data.results && data.results.length > 0) {
                        self.add(data.results);
                    }
                    if (success) success(data);
                }
            });
        }
    },
    load: function(success){
        var self = this;
        this.sync('read', 'products', {
            data: {
                keyword: $('input[name="keywords"]').val(),
                price_from: 1000,
                price_to: 2000,
            },
            success: function(data){                
                if (data.results && data.results.length > 0) {
                    self.add(data.results);
                }
                if (success) success(data);
            }
        });
    }
});

var ViewProductMini = Backbone.View.extend({
    template: Handlebars.compile( $('#tpl-product-item-mini').html() ),
    render: function() {
        this.$el = $(this.template(this.model.attributes));
        return this;
    },
    events: {
        'click .vendor a' : function(){
            console.log(this);
            alert('Данные о вендоре');
            return false;
        },
        'click .controls .control-compare' : function(){
            console.log(this);
            alert('Сравнить');
            return false;
        },
        'click .controls .control-favorite' : function(){
            console.log(this);
            alert('Добавить в избранное');
            return false;
        },
        'click .controls .price, .name, .image' : function(){
            var popup = new Scarlet.ViewProductPopup({model: this.model});
            return false;
        }
    },
    initialize: function(){
        this.render();
    }
});

Scarlet.ViewProductPopup = Backbone.View.extend({
    template: Handlebars.compile( $('#tpl-product-popup').html() ),
    render: function() {
        this.openPopup( $(this.template(this.model.attributes)) );
        
        Galleria.run('.popup .galleria');
        
        return this;
    },
    events: {
        //
    },
    initialize: function(){
        this.render();
    },
    openPopup: function(el, cls) {
        var popup = { el : $('<div class="popup opening"><div class="background"></div><div class="scroll"><div class="playout"></div></div>') },
            close = $('<div class="cross"></div>');
        
        popup.layout = popup.el.find('.playout'),
        popup.background = popup.el.find('.background')
        popup.scroll = popup.el.find('.scroll')
      
        if (cls) popup.el.addClass(cls);
      
        popup.layout.append(close);
        popup.layout.append(el);
        $('body').append(popup.el).addClass('haspopup');
        setTimeout(function(){
            popup.el.removeClass('opening');
        },1);
      
        popup.syncSize = function() {
            var ph = popup.layout.outerHeight(),
                pw = popup.layout.outerWidth(),
                wh = $(window).height()
        
            if (wh > ph+100) {
                popup.layout.css({
                    top : '50%',
                    marginLeft : pw*-0.5,
                    marginTop : ph*-0.5
                })
                popup.scroll.removeClass('active');
            } else {
                popup.layout.css({
                    top : 50,
                    marginLeft : pw*-0.5,
                    marginTop : 0
                }) 
                popup.scroll.addClass('active');
            }
        }
        popup.syncSize();
        popup.el.find('img').load(function(){
            popup.syncSize();
        })
        popup.el.on('resize', function(){
            popup.syncSize();
        })
        $(window).bind('resize.popup', function(){
            popup.syncSize();
        })
        popup.close = function() {  
            popup.el.addClass('closing');
            setTimeout(function(){
                popup.el.css('opacity', 0);
                setTimeout(function(){  
                    popup.el.remove();
                    if(!$('.popup').length) $('body').removeClass('haspopup'); 
                },1);
                $(window).unbind('.popup');
            }, 600);
            if (popup.onClose) popup.onClose();
        }
      
        close.click(function(){
            popup.close();
        })
        return popup;
    }
});

var App = new Scarlet();
