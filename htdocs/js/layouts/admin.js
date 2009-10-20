OvzWebPanel.Layouts.Admin = {};

OvzWebPanel.Layouts.Admin.autoResizeContentArea = function() {
	var contentHeightOffset = 91;	
	var contentWidthOffset = 250;	
	var layoutContent = document.getElementById('layoutContent');
	
	layoutContent.style.height = (document.body.scrollHeight - contentHeightOffset) + 'px';
	layoutContent.style.width = (document.body.scrollWidth - contentWidthOffset) + 'px';
}

Event.observe(window, 'load', function(event) {
	OvzWebPanel.Layouts.Admin.autoResizeContentArea();
});

Event.observe(window, 'resize', function(event) {
	OvzWebPanel.Layouts.Admin.autoResizeContentArea();
});
