KindEditor.ready(function(K) {
             var editor1 = K.create('textarea.edit', {
        	    width:'100%',
			    height:'400px',
                cssPath : '../../../assets/kindeditor/plugins/code/prettify.css',
                uploadJson : '../../../Keditor/upload', //控制器
                fileManagerJson : '../../../Keditor/manage', //控制器
                allowFileManager : true,
                 afterCreate : function() {
                     var self = this;
                     K.ctrl(document, 13, function() {
                         self.sync();
                         K('form[name=example]')[0].submit();
                     });
                     K.ctrl(self.edit.doc, 13, function() {
                         self.sync();
                         K('form[name=example]')[0].submit();
                     });
                 },
				afterChange : function() { 
					this.sync(); 
				}, 
				afterBlur:function(){ 
					this.sync(); 
				} 
             });
//             prettyPrint();
         });
         KindEditor.ready(function(K) {
                 var editor = K.editor({
                     allowFileManager : true
                 });
                 K('#image1').click(function() {
                     editor.loadPlugin('image', function() {
                         editor.plugin.imageDialog({
                             imageUrl : K('#url1').val(),
                             clickFn : function(url, title, width, height, border, align) {
                                 K('#url1').val(url);
                                 editor.hideDialog();
                             }
                         });
                     });
                 });  
             });