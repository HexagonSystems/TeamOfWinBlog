xmlhttp;

function formValidation(data, type) {
	xmlhttp = createStuff();

	xmlhttp.open("GET", "includes/php/register_formValidation.php?data=" + data
			+ "&type=" + type, true);

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
			}
		}
	}

}

function createStuff() {
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		return new XMLHttpRequest();
	} else {// code for IE6, IE5
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function createMessageBox(type, message) {
	var inputBox = document.getElementById("register_" + type);
	inputBox.style.border = "3px solid #FA4B3E";

	var messageBox = document.getElementById("message_" + type);
	messageBox.style.display = "table";
	messageBox.style.position = "absolute";
	messageBox.style.marginTop = "-45px";
	messageBox.style.minWidth = "200px";
	messageBox.style.zIndex = "3";
	messageBox.style.border = "1px solid black";
	messageBox.style.background = "#FFFFFF";
	messageBox.style.left = "80%";
	messageBox.style.borderRadius = "5px";
	messageBox.style.padding = "10px";
	messageBox.style.textSize = "20px";
	messageBox.style.boxShadow = "10px 5px 10px #888";
	messageBox.style.visibility = "visible";
	messageBox.innerHTML = message;
}

function hideMessageBox(type) {
	var messageBox = document.getElementById("message_" + type);
	messageBox.style.visibility = "hidden";
}

function validatePass(data) {
	if (data.length > 0) {
		if (data.length > 6) {
			document.getElementById("register_pass").style.border = "3px solid green";
			if (document.getElementById("message_pass").style.visibility == "visible") {
				hideMessageBox(type);
			}
		} else {
			createMessageBox('pass',
					"Password needs to be longer than 6 characters");
		}
	}
}