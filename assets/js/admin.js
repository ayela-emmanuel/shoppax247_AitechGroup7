

var product_form_container = document.querySelector("#product-form-container");
var create_buttons = document.querySelectorAll(".create_btn");

create_buttons.forEach(element => {
    element.addEventListener("click",()=>{
        product_form_container.classList.toggle("show")
    })
});






setTimeout(()=>{
    var error_message = document.querySelectorAll(".error-message");
    error_message.forEach(element => {
        element.remove();
    });
    
    //error-message
}
,8000)




