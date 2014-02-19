


$(document).ready(function () {

	var inputs = document.getElementsByTagName("input");
	for (var i = 0; i < inputs.length; i++) {
			if(inputs[i].type!="submit"){
		    inputs[i].value = inputs[i].getAttribute('placeholder');
		    inputs[i].addEventListener('focus', function() {
		        if (this.value == this.getAttribute('placeholder')) {
		            this.value = '';
		        }
		    });
		    inputs[i].addEventListener('blur', function() {
		        if (this.value == '') {
		            this.value = this.getAttribute('placeholder');
		        }
		    });
		}
	}

});