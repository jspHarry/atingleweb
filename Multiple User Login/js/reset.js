const form = document.querySelector(".form form"),
    submit = form.querySelector(".submit input"),
    text = form.querySelector(".error-text"),
    green = form.querySelector(".success-text");

form.onsubmit = (e) => {
    e.preventDefault();
}

submit.onclick = () => {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/reset_pass.php" , true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    green.textContent = "Password Changed";
                    green.style.display = "block";
                    text.style.display = "none";
                    setInterval('location.href = "./login.php"' , 300);
                }
                else{
                text.textContent = data;
                green.style.display = "none";
                text.style.display = "block";
                }
            }
        }
    };

let formData = new FormData(form);
xhr.send(formData);

};