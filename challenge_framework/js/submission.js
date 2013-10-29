

    $(document).ready(function () {
	
		var titlepatt = /^[a-zA-Z0-9.,-:?! ]+$/; 
       	   
        $('#submit').click(function(){
            var name = $('#appli-name').val();
            var desc = $('#appli-desc').val();
            var chall_id = $('#chall_id').val();
            var userid = $('#userid').val();
            var terms = $('input:checkbox[name=accept]').is(':checked');
			var file_cnt = $('#appli-file-cnt').val();
			var img_cnt = $('#appli-image-cnt').val();
			var image = $('#appli-image-1').val();
			
            if(name==''){
                alert('Application Name is Required.');
                $('#appli-name').focus();
                return false;
			}else if(!titlepatt.test(name)){
				alert('Invalid characters found on Application Name.');
                $('#appli-name').focus();
                return false;
            }else if(desc==''){
                alert('Application Description is Required.');
                $('#appli-desc').focus();
                return false;
            }else if($('#appli-image-2').length<1){
				alert('Please upload atleast one image.');
                return false;
			}else if(terms==false){
                alert('Please accept the condition to continue.');
                return false;
            }		
			else if(img_cnt >= 1){
				var flag = 0;
				for(var i = 1; i <= img_cnt; i++){
					var file = $('#appli-image-'+i).val();
					if(file!=''){
						flag = 1;
						var ext = getExtSVC(file);
						var f = document.getElementById('appli-image-'+i);
						var x = f.files[0];
						
						//alert(x.name);
						//alert(x.size);
						
						if(ext != "gif" && ext != "jpg" && ext != "jpeg" && ext != "png"){
							alert(x.name+' is not an image');
							return false;
						}
						if(x.size > 2000000){
							alert(x.name+' file size exceeds 2mb .');
							return false;
						}
					}
				}
				if(flag==0){
					alert('Please upload atleast one image.');
					return false;
				}
				else if(file_cnt >= 1){
					//alert(file_cnt);
					for(var i = 1; i <= file_cnt; i++){
						//alert(i);
						var file = $('#appli-file-'+i).val();
						if(file!=''){
						
							var f = document.getElementById('appli-file-'+i);
							var x = f.files[0];
							
							//alert(x.size);
							if(x.size > 5000000){
								alert(x.name+' file size exceeds 5mb .');
								return false;
							}
						}
					}
				}
			}
			
			
        });
		
		$('#img-more').click(function(){
			var x = $('#appli-image-cnt').val();
			var y = parseInt(x) + 1;
			$('#appli-image-cnt').val(y)
			$('#img-add-box').append('<input type="file" name="appli-image[]" id="appli-image-'+y+'"/>');
			
			return false;
		});
		
		$('#vid-more').click(function(){
			var x = $('#appli-vid-cnt').val();
			var y = parseInt(x) + 1;
			$('#appli-vid-cnt').val(y)
			$('#vid-add-box').append('Paste embed script here: <textarea name="appli-vid[]" id="appli-vid-'+y+'" class="in-desc"></textarea>');
			
			return false;
		});
		
		$('#file-more').click(function(){
			var x = $('#appli-file-cnt').val();
			var y = parseInt(x) + 1;
			$('#appli-file-cnt').val(y)
			$('#file-add-box').append('<input type="file" name="appli-file[]" id="appli-file-'+y+'"/>');
			
			return false;
		});
		
    });
	
		function getExtSVC(filename) {
			var dot_pos = filename.lastIndexOf(".");
			if(dot_pos == -1)
				return "";
			return filename.substr(dot_pos+1).toLowerCase();
		}