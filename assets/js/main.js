
function addToCart(id){
    fetch("/api/add_to_cart.php?id="+id).then((res)=>{
        if(res.status == 200){
            alert("Added To Cart")
        }else{
            alert("Failed To add To Cart")
        }
    })
}



//Minify
//Obfosticate
function showCart(){
    var cart = document.getElementById("cart")
    fetch("/api/get_cart.php").then((res)=>{
        if(res.status == 200){
            return res.json()
        }else{
            alert("Failed To Load Cart")
        }
    }).then((data)=>{
        var tags = "";
        data.forEach(element => {

            tags += generateProductCard(element)
        });
        cart.innerHTML = tags;
        console.table(data)
    })
}


function generateProductCard(data){
    return `<div class="card" style="width: 18rem;">
                <img class="card-img-top" src="${data.img}" alt="Card image cap"/>
                <div class="card-body">
                    <h5 class="card-title">${data.name}</h5>
                    <p class="card-text">NGN ${data.price}</p>
                </div>
            </div>`
}