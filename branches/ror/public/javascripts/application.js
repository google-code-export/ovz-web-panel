(function() {  
  Ext.BLANK_IMAGE_URL = '/images/blank.gif';

  Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
  
  Ext.QuickTips.init();
  
  // turn on validation errors beside the field globally
  Ext.form.Field.prototype.msgTarget = 'side';
})();

Ext.ns('Owp.form');

Owp.form.errorHandler = function(form, action, params) {
  if ('client' == action.failureType) {
    return
  }
  
  // show overall status message
  if ('undefined' != typeof action.result.message) {
    Ext.MessageBox.show({
      msg: action.result.message,
      buttons: Ext.MessageBox.OK,
      icon: Ext.MessageBox.ERROR,
      fn: params['fn']
    });
    
    return
  }
  
  // highlight fields with errors
  var errorsHash = new Array();  
  
  Ext.each(action.result.errors, function(message) {
    messageField = message[0];
    messageContent = message[1];
    
    errorsHash[messageField] = (errorsHash[messageField])
      ? errorsHash[messageField] + '<br/>' + messageContent
      : messageContent;
  });
    
  for (var index in form.items.items) {
    if ('function' == typeof errorsHash[index]) {
      continue
    }
 
    var field = form.items.items[index];
    
    if (('undefined' != field.name) && ('undefined' != typeof errorsHash[field.name])) {
        field.markInvalid(errorsHash[field.name])
    }
  }
    
}
