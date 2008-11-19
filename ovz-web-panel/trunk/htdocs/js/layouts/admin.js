Owp.Layouts.Admin.onLogoutLinkClick = function() {
	Ext.MessageBox.confirm('Confirm', 'Are you sure you want to log out?', function(button, text) {
		if ('yes' == button) {
			window.location.href = '/auth/logout';
		}
	});
}

Ext.onReady(function(event) {

	var windowAddShortcut;
	
	function addShortcut() {
		var currentLocation = window.location.pathname;
		
		if (!windowAddShortcut) {
			var formAddShortcut = new Ext.form.FormPanel({
				baseCls: 'x-plain',
				labelWidth: 100,
				url: '/admin/shortcut/add',
				defaultType: 'textfield',
				waitMsgTarget: true,
				
				items: [{
					fieldLabel: 'Title',
					name: 'name',
					value: Owp.Layouts.Admin.pageTitle,
					allowBlank: false,
					anchor: '100%'
				}, {
					fieldLabel: 'Link',
					name: 'link',
					value: currentLocation,
					allowBlank: false,
					anchor: '100%'
				}]
			});
			
			windowAddShortcut = new Ext.Window({
				title: 'Add shortcut to page',
				width: 400,
				height: 130,
				modal: true,
				layout: 'fit',
				plain: true,
				bodyStyle: 'padding:5px;',
				resizable: false,
				items: formAddShortcut,
				closeAction: 'hide',
				
				buttons: [{
					text: 'Add',
					handler: function() {
						formAddShortcut.form.submit({
							waitMsg: 'Loading...',
							success: function() {
								windowAddShortcut.hide();
							},
							failure: function(form, action) {
								var resultMessage = ('client' == action.failureType)
									? 'Please, fill the form.'
									: action.result.errors.message;
								
								Ext.MessageBox.show({
									title: 'Error',
									msg: resultMessage,
									buttons: Ext.MessageBox.OK,
									icon: Ext.MessageBox.ERROR
								});
							}
						});
					}
				},{
					text: 'Cancel',
					handler: function() {
						windowAddShortcut.hide();
					}
				}]
			});
			
			windowAddShortcut.on('show', function() {
				formAddShortcut.getForm().reset();
			});
		}
		
		windowAddShortcut.show();		
	}
	
	var topBar = [{
		text: 'Shortcut',
		handler: addShortcut,
		cls: 'x-btn-text-icon addShortcut'
	}];
	
	if ('' != Owp.Layouts.Admin.upLevelLink) {
		topBar.push({
			text: 'Up Level',
			handler: function() {
				document.location.href = Owp.Layouts.Admin.upLevelLink;
			},
			cls: 'x-btn-text-icon upLevelLink'
		});
	}
	
	var layout = new Ext.Viewport({
		layout:'border',
		items: [
			new Ext.BoxComponent({
				region: 'north',
				el: 'panelHeader',
				cls: 'x-panel-header',
				height: 50
			}), {
				region: 'west',
				title: 'Menu',
				contentEl: 'panelMenu',
				split:true,
				width: 250,
				minSize: 200,
				maxSize: 400,
				collapsible: true,
				margins: '5 0 5 5',
				layout: 'accordion',
				layoutConfig: { animate: true },				
				xtype: 'treepanel',
				loader: new Ext.tree.TreeLoader(),
				rootVisible: false,
				lines: false,
				root: Owp.Layouts.Admin.getMainMenu()
			}, {
				region: 'center',
				margins: '5 5 5 0',
				contentEl: 'panelContent',
				xtype: 'panel',
				title: Owp.Layouts.Admin.pageTitle,
				id: 'rightPanelHeader',
				tbar: topBar,
				bodyStyle: 'background: #FFFFFF url(/skins/win_xp/images/openvz-big-logo.gif) no-repeat scroll right bottom'
			}
		]
	});
	
});
