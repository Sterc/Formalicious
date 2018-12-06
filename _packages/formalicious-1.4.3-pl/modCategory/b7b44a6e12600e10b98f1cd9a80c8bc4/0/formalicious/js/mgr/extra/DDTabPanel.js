Ext.namespace('Ext.ux.panel');

/**
 * @class Ext.ux.panel.DDTabPanel
 * @extends Ext.TabPanel
 * @author
 *     Original by
 *         <a href="http://extjs.com/forum/member.php?u=22731">thommy</a> and
 *         <a href="http://extjs.com/forum/member.php?u=37284">rizjoj</a><br />
 *     Published and polished by: Mattias Buelens (<a href="http://extjs.com/forum/member.php?u=41421">Matti</a>)<br />
 *     With help from: <a href="http://extjs.com/forum/member.php?u=1459">mystix</a>
 *     Polished and debugged by: Tobias Uhlig (info@internetsachen.com) 04-25-2009
 *     Ported to Ext-3.1.1 by: Tobias Uhlig (info@internetsachen.com) 02-14-2010
 * @license Licensed under the terms of the Open Source <a href="http://www.gnu.org/licenses/lgpl.html">LGPL 3.0 license</a>. Commercial use is permitted to the extent that the code/component(s) do NOT become part of another Open Source or Commercially licensed development library or toolkit without explicit permission.
 * @version 2.0.0 (Feb 14, 2010)
 */
Ext.ux.panel.DDTabPanel = Ext.extend(Ext.TabPanel, {
    /**
    * @cfg {Number} arrowOffsetX The horizontal offset for the drop arrow indicator, in pixels (defaults to -9).
    */
    arrowOffsetX: -9,
    /**
    * @cfg {Number} arrowOffsetY The vertical offset for the drop arrow indicator, in pixels (defaults to -8).
    */
    arrowOffsetY: -8,

    // Assign the drag and drop group id
    /** @private */
    initComponent: function() {
        Ext.ux.panel.DDTabPanel.superclass.initComponent.call(this);
        this.addEvents('reorder');
        if (!this.ddGroupId) this.ddGroupId = 'dd-tabpanel-group-' + Ext.ux.panel.DDTabPanel.superclass.getId.call(this);
    },
    
    // New Event fired after drop tab
    reorder:function(tab, oldIndex, newIndex){
        this.fireEvent('reorder', this, tab, oldIndex, newIndex);
    },

    // Declare the tab panel as a drop target
    /** @private */
    afterRender: function() {
        Ext.ux.panel.DDTabPanel.superclass.afterRender.call(this);
        // Create a drop arrow indicator
        this.arrow = Ext.DomHelper.append(
            Ext.getBody(),
            '<div class="dd-arrow-down"></div>',
            true
        );
        this.arrow.hide();
        // Create a drop target for this tab panel
        var tabsDDGroup = this.ddGroupId;
        this.dd = new Ext.ux.panel.DDTabPanel.DropTarget(this, {
            ddGroup: tabsDDGroup
        });

        // needed for the onRemove-Listener
        this.move = false;
    },

    // Init the drag source after (!) rendering the tab
    /** @private */
    initTab: function(tab, index) {
        Ext.ux.panel.DDTabPanel.superclass.initTab.call(this, tab, index);

        var id = this.id + '__' + tab.id;
        // Hotfix 3.2.0
        Ext.fly(id).on('click', function() { tab.ownerCt.setActiveTab(tab.id); });
        // Enable dragging on all tabs by default
        Ext.applyIf(tab, { allowDrag: true });

        // Extend the tab
        Ext.apply(tab, {
            // Make this tab a drag source
            ds: new Ext.dd.DragSource(id, {
                ddGroup: this.ddGroupId
                , dropEl: tab
                , dropElHeader: Ext.get(id, true)
                , scroll: false

                // Update the drag proxy ghost element
                , onStartDrag: function() {
                    if (this.dropEl.iconCls) {

                        var el = this.getProxy().getGhost().select(".x-tab-strip-text");
                        el.addClass('x-panel-inline-icon');

                        var proxyText = el.elements[0].innerHTML;
                        proxyText = Ext.util.Format.stripTags(proxyText);
                        el.elements[0].innerHTML = proxyText;

                        el.applyStyles({
                            paddingLeft: "20px"
                        });
                    }
                }

                // Activate this tab on mouse up
                // (Fixes bug which prevents a tab from being activated by clicking it)
                , onMouseUp: function(event) {
                    if (this.dropEl.ownerCt.move) {
                        if (!this.dropEl.disabled && this.dropEl.ownerCt.activeTab == null) {
                            this.dropEl.ownerCt.setActiveTab(this.dropEl);
                        }
                        this.dropEl.ownerCt.move = false;
                        return;
                    }
                    if (!this.dropEl.isVisible() && !this.dropEl.disabled) {
                        this.dropEl.show();
                    }
                }
            })
            // Method to enable dragging
            , enableTabDrag: function() {
                this.allowDrag = true;
                return this.ds.unlock();
            }
            // Method to disable dragging
            , disableTabDrag: function() {
                this.allowDrag = false;
                return this.ds.lock();
            }
        });

        // Initial dragging state
        if (tab.allowDrag) {
            tab.enableTabDrag();
        } else {
            tab.disableTabDrag();
        }
    }

    /** @private */
    , onRemove: function(c) {
        var te = Ext.get(c.tabEl);
        // check if the tabEl exists, it won't if the tab isn't rendered
        if (te) {
            // DragSource cleanup on removed tabs
            //Ext.destroy(c.ds.proxy, c.ds);
            te.select('a').removeAllListeners();
            Ext.destroy(te);
        }

        // ignore the remove-function of the TabPanel
        Ext.TabPanel.superclass.onRemove.call(this, c);

        this.stack.remove(c);
        delete c.tabEl;
        c.un('disable', this.onItemDisabled, this);
        c.un('enable', this.onItemEnabled, this);
        c.un('titlechange', this.onItemTitleChanged, this);
        c.un('iconchange', this.onItemIconChanged, this);
        c.un('beforeshow', this.onBeforeShowItem, this);

        // if this.move, the active tab stays the active one
        if (c == this.activeTab) {
            if (!this.move) {
                var next = this.stack.next();
                if (next) {
                    this.setActiveTab(next);
                } else if (this.items.getCount() > 0) {
                    this.setActiveTab(0);
                } else {
                    this.activeTab = null;
                }
            }
            else {
                this.activeTab = null;
            }
        }
        if (!this.destroying) {
            this.delegateUpdates();
        }
    }


    // DropTarget and arrow cleanup
    /** @private */
    , onDestroy: function() {
        Ext.destroy(this.dd, this.arrow);
        Ext.ux.panel.DDTabPanel.superclass.onDestroy.call(this);
    }
});

// Ext.ux.panel.DDTabPanel.DropTarget
// Implements the drop behavior of the tab panel
/** @private */
Ext.ux.panel.DDTabPanel.DropTarget = Ext.extend(Ext.dd.DropTarget, {
    constructor: function(tabpanel, config){
        this.tabpanel = tabpanel;
        // The drop target is the tab strip wrap
        Ext.ux.panel.DDTabPanel.DropTarget.superclass.constructor.call(this, tabpanel.stripWrap, config);
    }

    ,notifyOver: function(dd, e, data){
        var tabs = this.tabpanel.items;
        var last = tabs.length;

        if(!e.within(this.getEl()) || dd.dropEl == this.tabpanel){
            return 'x-dd-drop-nodrop';
        }

        var larrow = this.tabpanel.arrow;

        // Getting the absolute Y coordinate of the tabpanel
        var tabPanelTop = this.el.getY();

        var left, prevTab, tab;
        var eventPosX = e.getPageX();

        for(var i = 0; i < last; i++){
            prevTab = tab;
            tab     = tabs.itemAt(i);
            // Is this tab target of the drop operation?
            var tabEl = tab.ds.dropElHeader;
            // Getting the absolute X coordinate of the tab
            var tabLeft = tabEl.getX();
            // Get the middle of the tab
            var tabMiddle = tabLeft + tabEl.dom.clientWidth / 2;

            if(eventPosX <= tabMiddle){
                left = tabLeft;
                break;
            }
        }
        
        if(typeof left == 'undefined'){
            var lastTab = tabs.itemAt(last - 1);
            if(lastTab == dd.dropEl)return 'x-dd-drop-nodrop';
            var dom = lastTab.ds.dropElHeader.dom;
            left = (new Ext.Element(dom).getX() + dom.clientWidth) + 3;
        }
        
        else if(tab == dd.dropEl || prevTab == dd.dropEl){
            this.tabpanel.arrow.hide();
            return 'x-dd-drop-nodrop';
        }

        larrow.setTop(tabPanelTop + this.tabpanel.arrowOffsetY).setLeft(left + this.tabpanel.arrowOffsetX).show();

        return 'x-dd-drop-ok';
    }

    ,notifyDrop: function(dd, e, data){
        this.tabpanel.arrow.hide();
        var activeTab = this.tabpanel.getActiveTab();
        var oldIndex = this.tabpanel.items.findIndex('id', activeTab.id);

        // no parent into child
        if(dd.dropEl == this.tabpanel){
            return false;
        }
        var tabs      = this.tabpanel.items;
        var eventPosX = e.getPageX();

        for(var i = 0; i < tabs.length; i++){
            var tab = tabs.itemAt(i);
            // Is this tab target of the drop operation?
            var tabEl = tab.ds.dropElHeader;
            // Getting the absolute X coordinate of the tab
            var tabLeft = tabEl.getX();
            // Get the middle of the tab
            var tabMiddle = tabLeft + tabEl.dom.clientWidth / 2;
            if(eventPosX <= tabMiddle) break;
        }

        // do not insert at the same location
        if(tab == dd.dropEl || tabs.itemAt(i-1) == dd.dropEl){
            return false;
        }
        
    dd.proxy.hide();

        // if tab stays in the same tabPanel
        if(dd.dropEl.ownerCt == this.tabpanel){
            if(i > tabs.indexOf(dd.dropEl))i--;
        }

        this.tabpanel.move = true;
        var dropEl = dd.dropEl.ownerCt.remove(dd.dropEl, false);
        
        this.tabpanel.insert(i, dropEl);
        // Event drop
        this.tabpanel.fireEvent('drop', this.tabpanel);
        // Fire event reorder
        //Old = oldIndex || New = i
        this.tabpanel.reorder(tabs.itemAt(i), oldIndex, i);

        return true;
    }

    ,notifyOut: function(dd, e, data){
        this.tabpanel.arrow.hide();
    }
});

Ext.reg('ddtabpanel', Ext.ux.panel.DDTabPanel);