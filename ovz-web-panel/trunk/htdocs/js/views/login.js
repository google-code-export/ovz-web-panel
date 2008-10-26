Ext.onReady(function(event) {

	var loginForm = new Ext.FormPanel({
		labelWidth: 75,
		baseCls: 'x-plain',
		url: '/login',
		bodyStyle: 'padding:15px 15px 0',
		width: 350,
		defaults: { width: 230 },
		defaultType: 'textfield',
		
		onSubmit: Ext.emptyFn,		
		submit: function() {
			this.getForm().getEl().dom.submit();
		},
		
		items: [{
				fieldLabel: 'User name',
				name: 'userName',
				id: 'userName',
				allowBlank: false
			},{
				fieldLabel: 'Password',
				name: 'userPassword',
				inputType: 'password',
				allowBlank: false
			}
		],

		buttons: [{
			text: 'Log in',
			type: 'submit',
			handler: function() {
				loginForm.submit();
			}
		}]
	});
	
	var loginWindow = new Ext.Window({
		applyTo: 'loginWindow',
		width: 350,
		height: 145,
		y: 150,
		closable: false,
		resizable: false,
		draggable: false,
		items: loginForm
	});
	
	loginWindow.show();
});

Ext.EventManager.on(window, 'load', function() {
	Ext.get('userName').focus();
});