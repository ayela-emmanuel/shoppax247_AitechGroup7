

var product_form_container = document.querySelector("#product-form-container");
var create_buttons = document.querySelectorAll(".create_btn");

create_buttons.forEach(element => {
    element.addEventListener("click",()=>{
        product_form_container.classList.toggle("show")
    })
});







