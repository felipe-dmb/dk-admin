window.addEventListener('load',clientForm);


function clientForm(){
	var form = 'form#clientForm';
	var url = 'ajax/client_validation.php';
	handleForm(form,url);
}

function handleForm(formQuerySelector,url){
	var hasForm = Boolean(document.querySelector(formQuerySelector));
	if(!hasForm){
		return;
	}
	var form = document.querySelector(formQuerySelector);	
	var submit = form.submit;
	var elements = form.elements;
	var element;
	var hasName;
	for(var i = 0; i < elements.length ; i++){
		element = elements[i];
		hasName = Boolean(element.name);
		if(hasName){
			element.addEventListener('change',function(){
				checkFieldXHR(this,url);
			});
			element.addEventListener('blur',function(){
				checkFieldXHR(this,url);
			});
			
		}
	}
	submit.addEventListener('click',handleClientFormClick =function(e){
		checkFormXHR(this.form,url);
		e.preventDefault();
	})
}
function checkFormXHR(form,url){
	var elements = form.elements;
	var messageBody = '';
	var element;
	var hasName;
	var isRadio;
	var isCheckBox;
	var isChecked;
	for(var i = 0; i < elements.length; i++){
		element = elements[i];
		hasName = Boolean(element.name);
		if(hasName){
			isRadio = Boolean(element.type == 'radio');
			isCheckBox = Boolean(element.type == 'checkbox');
			if(isRadio || isCheckBox){
				isChecked = element.checked;
				if(isChecked){
					messageBody += element.name + '=' + encodeURI(element.value) + '&';
				}
			}else{
				messageBody += element.name + '=' + encodeURI(element.value) + '&';
			}
		}
	}
	XHRValidation(url,messageBody,validForm,form);
}

function checkFieldXHR(element,url){
	var name = element.name;
	var value = encodeURI(element.value);
	var isRadio = Boolean(element.type == 'radio');
	var isCheckBox = Boolean(element.type == 'checkbox');
	var isChecked;
	var hasClientId;
	if(isRadio || isCheckBox){
		isChecked = element.checked;
		if(isChecked){
			messageBody = name + "=" + value;
		}
	}else{
		messageBody = name + "=" + value;
	}
	hasClientId = Boolean(document.querySelector("input[name='clientId']"));
	if(hasClientId){
		messageBody += "&clientId=" + document.querySelector("input[name='clientId']").value;
	}
	
	XHRValidation(url,messageBody,validField,element);
}

function validForm(response,form){
	var obj = response;
	var elements = form.elements;
	var element;
	for(var i = 0; i < elements.length; i++){
		element = elements[i];
		if(obj.hasOwnProperty(element.name)){
			validField(response,element);
		}
	}
	if(form.reportValidity()){
		form.submit.removeEventListener('click',handleClientFormClick);
		form.submit.click();
	}
}

function validField(response,element){
	var obj = response;
	var name = element.name;
	var field = obj[name];
	var valid = field.valid;
	var hasClient;
	if(field.hasOwnProperty('hasClient')){
		hasClient = field.hasClient;
		if(hasClient){
			element.className = "form-control is-invalid";
			element.setCustomValidity("Este Cliente Já Existe!");
			return;
		}else{
			if(field.valid){
				element.className = "form-control is-valid";
				element.setCustomValidity("");
				return;
			}else{
				element.className = "form-control is-invalid";
				element.setCustomValidity("Campo Inválido!");
				return;
			}
		}
	//If hasClient doesn't exist
	}else{
		if(field.valid){
			element.className = "form-control is-valid";
			element.setCustomValidity("");
			return;
		}else{
			element.className = "form-control is-invalid";
			element.setCustomValidity("Campo Inválido!");
			return;
		}
	}
}

function XHRValidation(url,messageBody,callBack,element){
	var xhr = new XMLHttpRequest();
	xhr.open('POST', url);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.responseType = 'json';
	xhr.send(messageBody);
	xhr.onload = function(){
		callBack(this.response,element);
	}
}