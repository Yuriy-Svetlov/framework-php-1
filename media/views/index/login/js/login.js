
var $username_INPUT = document.getElementById("username_INPUT"), 
	$password_INPUT = document.getElementById("password_INPUT"),
	$save_login_CHECKBOX = document.getElementById("save_login_CHECKBOX"), 
    $username = document.getElementById("username"), 
	$password = document.getElementById("password"),	
	$login_BUT = document.getElementById("login_BUT");


$login_BUT.addEventListener("click", function(){

    $data = {};
    $data.username = $username_INPUT.value;
    $data.password = $password_INPUT.value;
    $data.save_login = $save_login_CHECKBOX.checked;

    send($data);
}); 


$username_INPUT.addEventListener("input", function(){
    $username.textContent = "";
    $password.textContent = "";
});

$password_INPUT.addEventListener("input", function(){
    $username.textContent = "";
    $password.textContent = "";
});


function send($data){
	var http = new XMLHttpRequest();
	var url = '//'+window.location.hostname+'/login';
	http.open('POST', url, true);
	http.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
	http.timeout = 20000; // 10 seconds

	http.onreadystatechange = function() {
	    if(http.readyState === 4) {
	    	if(http.status === 200){

			    $username.textContent = "";
			    $password.textContent = "";
			    $save_login_CHECKBOX.checked = false;

	    		//--------------
	    		let data;
				try
				{
				   data = JSON.parse(http.responseText);
				}
				catch(e)
				{
				   alert('invalid json');
				}

	    		if(data.status === "OK"){
	    			window.location.replace(window.location.origin);
	    		}else{
	    			setError(data.error.property, data.error.message);
	    		}
	    		//--------------
	    	}	
	    }
	}

	http.send(JSON.stringify($data));
}


function setError(obj, msg){
	document.getElementById(obj).textContent = msg;
}