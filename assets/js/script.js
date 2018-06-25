$(document).ready(function(){
	
	var camera = $('#camera'),
		photos = $('#photos'),
		screen =  $('#screen');

	var template = '<a href="uploads/original/{src}" rel="cam" '
		+'style="background-image:url(uploads/thumbs/{src})"></a>';

	/*----------------------------------
		Setting up the web camera
	----------------------------------*/


	webcam.set_swf_url('assets/webcam/webcam.swf');
	webcam.set_api_url('p_wp_save.php');	// The upload script
	webcam.set_quality(80);				// JPEG Photo Quality
	webcam.set_shutter_sound(true, 'assets/webcam/shutter.mp3');
	
	// Generating the embed code and adding it to the page:	
		screen.html(
		webcam.get_html(screen.width(), screen.height())
	);


	function display_allert()
 	 {
  		alert("Data berhasil disimpan!!");
  		location = "http://bdgdrcwpjnb01/wp1/wp_tampil.php";
	
  	 }
 
 
 /*-----------------------------------
Timer 5 detik
-------------------------------------*/


function doStuff()
{

  //do some things
  setTimeout(continueExecution, 5000) //wait ten seconds before continuing
}




function continueExecution()
{
	
   webcam.freeze();
   togglePane();
}


function timer(){
  var counter = 5;

  setInterval(function timer() {
    counter--;
    if (counter >= 0) {
      span = document.getElementById("timerButton");
      span.innerHTML = counter;
    
      
    }
    // Display 'counter' wherever you want to display it.
    if (counter === 1) {
		
       span.innerHTML = "Cheessee";
    }
    
    if (counter === 0) {
		
       span.innerHTML = "Timer";
    }
    
  }, 1000);

    
}
	/*----------------------------------
		Binding event listeners
	----------------------------------*/


	var shootEnabled = false;
    
    
	$('#timerButton').click(function(){
		
	if(!shootEnabled){
	
	return false;
		
	}
		
	
	    timer();
		doStuff();	
	
		
		return false;
		
	
	});
		
	$('#shootButton').click(function(){
		if(!shootEnabled){
			return false;
		}
		
		webcam.freeze();
        
		togglePane();	
		return false;
		
	});
	
	$('#cancelButton').click(function(){
	    
		webcam.reset();
		togglePane();
		//clearInterval(counter);
		return false;
	});
	
	$('#uploadButton').click(function(){
		if ($('#no_reg').val()=="") {
			alert('no registrasi tidak boleh kosong!!');
			return false;
		}
	    $.cookies.set('no_reg',$('#no_reg').val());
	    if ($('#no_reg').val() != $('#no_reg2').val()){
			alert('Nomor regisrasi tidak terdaftar');
			return false;
			}
	    
	    if ($('#nama_kontraktor').val()==""){
			alert('Nama kontraktor tidak boleh kosong!!');
			return false;
	    }
		$.cookies.set('nama_kontraktor',$('#nama_kontraktor').val());
		
		
		if ($('#telp_kontraktor').val()==""){
			alert('Phone tidak boleh kosong!!');
			return false;
			}
		$.cookies.set('telp_kontraktor',$('#telp_kontraktor').val());
		
		
		if ($('#tools').val()==""){
			alert('Tools tidak boleh kosong!!');
			return false;
			}
		$.cookies.set('tools',$('#tools').val());
		
		
		if ($('#status').val()==""){
			alert('Working status harus dipilih!!');
			return false;
			}
		$.cookies.set('status',$('#status').val());
		
		
		if ($('#kontraktor').val()==""){
			alert('Kontraktor tidak boleh kosong!!');
			return false;
			}
		$.cookies.set('kontraktor',$('#kontraktor').val());
		
		
		if ($('#jml_orang').val()==""){
			alert('Quantity of person tidak boleh kosong!!');
			return false;
			}
		$.cookies.set('jml_orang',$('#jml_orang').val());
		
		
		if ($('#jns_pekerjaan').val()==""){
			alert('Job description tidak boleh kosong!!');
			return false;
			}
		$.cookies.set('jns_pekerjaan',$('#jns_pekerjaan').val());
		
		
		
		if ($('lantai').val()==""){
			alert('Lantai tidak boleh kosong!!');
			return false;
			}
		$.cookies.set('lantai',$('#lantai').val());
		
		if ($('#tgl1').is(':checked')) {
        	$.cookies.set('tgl1',$('#tgl1').val());
    		} 
    		else $.cookies.set('tgl1','');   	
    		
    	if ($('#tgl2').is(':checked')) {
        	$.cookies.set('tgl2',$('#tgl2').val());
    		} 
    		else $.cookies.set('tgl2',''); 	
    		
    	if ($('#tgl3').is(':checked')) {
        	$.cookies.set('tgl3',$('#tgl3').val());
    		} 
    		else $.cookies.set('tgl3',''); 
    		
		if ($('#tgl4').is(':checked')) {
        	$.cookies.set('tgl4',$('#tgl4').val());
    		} 
    		else $.cookies.set('tgl4',''); 
    		
		if ($('#tgl5').is(':checked')) {
        	$.cookies.set('tgl5',$('#tgl5').val());
    		} 
    		else $.cookies.set('tgl5',''); 
    		
		if ($('#tgl6').is(':checked')) {
        	$.cookies.set('tgl6',$('#tgl6').val());
    		} 
    		else $.cookies.set('tgl6',''); 
    		
		if ($('#tgl7').is(':checked')) {
        	$.cookies.set('tgl1',$('#tgl7').val());
    		} 
    		else $.cookies.set('tgl7',''); 
    		
		if ($('#tgl8').is(':checked')) {
        	$.cookies.set('tgl8',$('#tgl8').val());
    		} 
    		else $.cookies.set('tgl8',''); 
	
		if ($('#jam_mulai').val()=="hour"){
			alert('Jam mulai tidak boleh kosong!!');
			return false;
			}
		$.cookies.set('jam_mulai',$('#jam_mulai').val());
		$.cookies.set('menit_mulai',$('#menit_mulai').val());
		if ($('#jam_selesai').val()=="hour"){
			alert('Jam selesai tidak boleh kosong!!');
			return false;
			}
		$.cookies.set('jam_selesai',$('#jam_selesai').val());
		$.cookies.set('menit_selesai',$('#menit_selesai').val());
		$.cookies.set('no_reg2',$('#no_reg2').val());
		$.cookies.set('no_id',$('#no_id').val());
		$.cookies.set('tgl_reg',$('#tgl_reg').val());
		$.cookies.set('cek',$('#cek').val());
		
		
		

		webcam.upload();
		display_allert();

		return false;
	});

	camera.find('.settings').click(function(){
		if(!shootEnabled){
			return false;
		}
		
		webcam.configure('camera');
	});

	// Showing and hiding the camera panel:
	
	var shown = true;
	$('.camTop').click(function(){
		
		$('.tooltip').fadeOut('fast');
		
		if(shown){
			camera.animate({
				bottom:-466
			});
		}
		else {
			camera.animate({
				bottom:-5
			},{easing:'easeOutExpo',duration:'slow'});
		}
		
		shown = !shown;
	});

	$('.tooltip').mouseenter(function(){
		$(this).fadeOut('fast');
	});


	/*---------------------- 
		Callbacks
	----------------------*/
	
	
	webcam.set_hook('onLoad',function(){
		// When the flash loads, enable
		// the Shoot and settings buttons:
		shootEnabled = true;
	});
	
	webcam.set_hook('onComplete', function(msg){
		
		// This response is returned by upload.php
		// and it holds the name of the image in a
		// JSON object format:
		
		msg = $.parseJSON(msg);
		
		if(msg.error){
			alert(msg.message);
		}
		else {
			// Adding it to the page;
			photos.prepend(templateReplace(template,{src:msg.filename}));
			initFancyBox();
		}
	});
	
	webcam.set_hook('onError',function(e){
		screen.html(e);
	});
	
	
	/*-------------------------------------
		Populating the page with images
	-------------------------------------*/

	

	/*----------------------
		Helper functions
	------------------------*/

	
	// This function initializes the
	// fancybox lightbox script.
	
//	function initFancyBox(filename){
//		photos.find('a:visible').fancybox({
//			'transitionIn'	: 'elastic',
//			'transitionOut'	: 'elastic',
//			'overlayColor'	: '#111'
//		});
//	}


	// This function toggles the two
	// .buttonPane divs into visibility:
	
	function togglePane(){
		var visible = $('#camera .buttonPane:visible:first');
		var hidden = $('#camera .buttonPane:hidden:first');
		
		visible.fadeOut('fast',function(){
			hidden.show();
		});
	}
	
	
	// Helper function for replacing "{KEYWORD}" with
	// the respectful values of an object:
	
	function templateReplace(template,data){
		return template.replace(/{([^}]+)}/g,function(match,group){
			return data[group.toLowerCase()];
		});
	}
});
