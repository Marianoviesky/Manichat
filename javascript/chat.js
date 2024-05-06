const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");
let filein = document.querySelector(".file-input");
const emjs = document.querySelector("li");
const Msg = document.querySelector(".input-field");
const emojiBt=document.querySelector(".fa-face-smile");


form.onsubmit = (e)=>{
    e.preventDefault();
}

filein.addEventListener("input",()=>{
    if(filein.files && filein.files[0]){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }    
})
inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}


function touch(input) {
   const Msg = document.querySelector(".input-field");
    Msg.value +=input;
    if(Msg.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

emojiBt.onclick=()=>{
    if (emjs.classList.contains('view')) {
        emjs.classList.remove('view');
    }else{
        emjs.classList.add('view');

    }
}
Msg.addEventListener("keydown",()=>{
    if (emjs.classList.contains('view')) {
        emjs.classList.remove('view');
    }
})

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
    filein.value='';
    sendBtn.classList.remove("active");
    emjs.classList.remove('view');

}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
    emjs.classList.remove('view');


}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
    emjs.classList.remove('view');

}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  
