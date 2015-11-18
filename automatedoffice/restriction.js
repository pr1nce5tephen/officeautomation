
function checkInput(ob) {
  var invalidChars = /[^".* "a-zA-Z0-9]/gi
  if(invalidChars.test(ob.value)) {
            ob.value = ob.value.replace(invalidChars,"");
      }
}

function checkInput2(ob) {
  var invalidChars = /[^0-9]/gi
  if(invalidChars.test(ob.value)) {
            ob.value = ob.value.replace(invalidChars,"");
      }
}

function checkInputa(ob) {
  var invalidChars = /[^"., "a-zA-Z]/gi
  if(invalidChars.test(ob.value)) {
            ob.value = ob.value.replace(invalidChars,"");
      }
}

function checkInputdot(ob) {
  var invalidChars = /[^"., "0-9]/gi
  if(invalidChars.test(ob.value)) {
            ob.value = ob.value.replace(invalidChars,"");
      }
}

function checkInputl(ob){
  var invalidChars = /[^a-zA-Z]/gi
  if(invalidChars.test(ob.value)){
      ob.value= ob.value.replace(invalidChars,"");
  }
}