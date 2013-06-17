xmlhttp;

/**
 * formValidation
 * 
 * @param data
 * @param type
 */
function formValidation(data, type) {
	xmlhttp = createStuff();

	xmlhttp.open("GET", "includes/php/register_" + type
			+ "Validation.php?data=" + data + "&type=" + type, true);

	xmlhttp.onreadystatechange = process;

	xmlhttp.send();

	function process() {

		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			response = xmlhttp.responseText;
			element_id = document.getElementById("register_" + type);
			if (response !== "null") {
				if (response === "true") {
					element_id.style.border = "3px solid green";
					if (document.getElementById("message_" + type).style.visibility == "visible") {
						hideMessageBox(type);
					}
				} else {
					// $element_id.style.border = "3px solid red";
					createMessageBox(type, response);
				}
			} else {
				element_id.style.border = "3px solid #C4C4C4";
				if (document.getElementById("message_" + type).style.visibility == "visible") {
					hideMessageBox(type);
				}
			}
		}
	}

}

function checkEmpty(element_id) {
	element_id = document.getElementById(element_id);
	if (empty(element_id.value)) {
		return true;
	} else {
		return false;
	}
}
/*
 * function submitForm() { values = array('username', 'email', 'pass');
 * 
 * foreach(values as id){ element_id = document.getElementById(id);
 * if(checkEmpty("register_" + id)) { createMessageBox(id, "Please enter in your " +
 * id); }else { } } }
 */
function createStuff() {
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		return new XMLHttpRequest();
	} else {// code for IE6, IE5
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function usernameValidation(username) {
	if (/\s/g.test(username)) {
		createMessageBox('username',
				"Please remove any white space from your username");
	} else {
		formValidation(username, 'username');
	}

}

function createMessageBox(type, message) {
	var inputBox = document.getElementById("register_" + type);
	inputBox.style.border = "3px solid #FA4B3E";

	var messageBox = document.getElementById("message_" + type);

	messageBox.innerHTML = message;
	messageBox.style.visibility = "visible";

}

function hideMessageBox(type) {
	var messageBox = document.getElementById("message_" + type);
	messageBox.style.visibility = "hidden";
}