OvzWebPanel.Layouts.Admin = {};

OvzWebPanel.Layouts.Admin.autoResizeContentArea = function() {
	var contentHeightOffset = 91;	
	var contentWidthOffset = 250;	
	var layoutContent = Ext.get('layoutContent');
	
	layoutContent.setHeight(document.body.scrollHeight - contentHeightOffset);
	layoutContent.setWidth(document.body.scrollWidth - contentWidthOffset);
}

Ext.EventManager.onWindowResize(function(event) {
	OvzWebPanel.Layouts.Admin.autoResizeContentArea();
});

Ext.onReady(function(event) {
	OvzWebPanel.Layouts.Admin.autoResizeContentArea();
	
	Ext.get('mainMenuGeneralLogoutLink').on('click', function(e){
		Ext.MessageBox.confirm('Confirm', 'Are you sure you want to log out?', function(button, text) {
			if ('yes' == button) {
				window.location.href = '/auth/logout';
			}
		});
	});
});
