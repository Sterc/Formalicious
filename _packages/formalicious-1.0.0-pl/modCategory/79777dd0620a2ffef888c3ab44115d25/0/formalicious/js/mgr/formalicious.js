var Formalicious = function(config) {
    config = config || {};
    Formalicious.superclass.constructor.call(this,config);
};
Ext.extend(Formalicious,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('formalicious',Formalicious);
Formalicious = new Formalicious();



Ext.ux.Image = Ext.extend(Ext.Component, {
    url  : '',  //for initial src value

    autoEl: {
        tag: 'img',
        src: Ext.BLANK_IMAGE_URL,
        cls: 'tng-managed-image',
        width: 200,
        height: 200
    },
//  Add our custom processing to the onRender phase.
//  We add a ‘load’ listener to our element.
    onRender: function() {
        Ext.ux.Image.superclass.onRender.apply(this, arguments);
        this.el.on('load', this.onLoad, this);
        if(this.url){
            this.setSrc(this.url);
        }
    },
    onLoad: function() {
        this.fireEvent('load', this);
    },
    setSrc: function(src, source) {
        if(src == '' || src == undefined) {
            this.el.dom.src = Ext.BLANK_IMAGE_URL;
            if(Ext.getCmp('preview'))
                Ext.getCmp('preview').hide();
        }
        else {
            //this.el.dom.src = MODx.config.base_url + src;
            if (/(jpg|gif|png|JPG|GIF|PNG|JPEG|jpeg)$/.test(src)){ // image url as input

                this.el.dom.src = MODx.config.connectors_url+'system/phpthumb.php?h=200&w=200&zc=1&src=' + src+'&source='+source;
                if(Ext.getCmp('preview'))
                    Ext.getCmp('preview').show();
            }else{
                this.el.dom.src = Ext.BLANK_IMAGE_URL;
                if(Ext.getCmp('preview'))
                    Ext.getCmp('preview').hide();
                
            }
        }
    }
});
Ext.reg('image', Ext.ux.Image);

