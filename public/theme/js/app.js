// get current year
const year = new Date().getFullYear();
const footerYear = document.querySelector('.year');
footerYear.innerHTML = year;

// poulse social icons every few seconds

setInterval(function() {
    // console.log('ilija'); INTERVAL RADI
    const socialIcons = document.querySelectorAll('.social-icon');
    socialIcons.forEach(icon => {
        icon.classList.add('social-icon-js');
        setTimeout(function () {
            icon.classList.remove('social-icon-js')
        }, 100)
        
        setTimeout(function () {
            icon.classList.add('social-icon-js');
            setTimeout(function () {
                icon.classList.remove('social-icon-js')
            }, 100)
        }, 200)

    })
},10000);

if(window.location.href.indexOf('single_court_controler.php') >= 0) {
    // SINGLE COURT PAGE

    // calculate court rating

    const allRatings = document.querySelectorAll('.stars');

    let ratings = 0;
    let numOfComments = 0;

    allRatings.forEach(rating => {
        ratings += +rating.innerHTML;
        numOfComments++;
    })

    const avgRating = Math.round(ratings / numOfComments);

    let avgStars = document.querySelector('.avgStars');

    let addStars = '';
    for(let i = 0; i < avgRating; i++) {
        addStars += `<img src="./public/theme/img/icons/star.png" alt="star icon" style="display: inline; width: 20px; height: 20px;"/>`
    }

    avgStars.innerHTML = addStars;
    
} else if (window.location.href.indexOf('courts_page_controler.php') >= 0) {

    // all ratings
    const avgRating = document.querySelectorAll('.avg-rating');


    avgRating.forEach(rating => {
        const ratingNum = rating.textContent;

        let avgRatingInnerText = '';
        for (let i = 0; i < ratingNum; i++) {
            avgRatingInnerText += `<img src="./public/theme/img/icons/star.png" alt="star icon" style="display: inline; width: 20px; height: 20px;"/>`;
            rating.innerHTML = avgRatingInnerText;
        }
    })
} else if (window.location.href.indexOf('products_page_controler.php') >= 0) {
    // change number of items in badge in header
    const badge = document.querySelector('.badge');
    if(sessionStorage.getItem('cartItems')) {
        let cartItems = JSON.parse(sessionStorage.getItem("cartItems"));
        const numOfItems = cartItems.length || '0';
        badge.innerHTML = numOfItems; 
    }

    const buttons = document.querySelectorAll('.add-to-cart-btn');

    buttons.forEach(button => {
        button.addEventListener('click', e => {
            
            const btnId = button.getAttribute('id'); // getting attr id
            const quantity = 1;
            const image = button.parentElement.parentElement.parentElement.firstElementChild.getAttribute('src');
            const name = button.parentElement.parentElement.firstElementChild.firstElementChild.innerHTML;
            const price = button.parentElement.parentElement.firstElementChild.nextElementSibling.firstElementChild.firstElementChild.innerHTML;
            const stock = button.parentElement.parentElement.firstElementChild.nextElementSibling.nextElementSibling.firstElementChild.innerHTML;

            let item = {id: btnId, quantity: quantity, image: image, name: name, price: price, stock: stock};
            let items = [];

            // if sesstion is empty create one
            if (sessionStorage.getItem("cartItems") === null) {
                items.push(item);

                 // change number of items in badge in header
                 const badge = document.querySelector('.badge');
                 const numOfItems = items.length;
                 badge.innerHTML = numOfItems;

                sessionStorage.setItem("cartItems", JSON.stringify(items));
            } 
            // if session is not empty check if item is already in session
            // if it is just update quantity
            // if NOT then add new item to session
            else {
                let cartItems = JSON.parse(sessionStorage.getItem("cartItems"));
                let cartItemExist = false;
                
                cartItems.forEach(item => {
                    if(btnId == item.id) {
                        // item.quantity++;
                        cartItemExist = true;
                    }
                })
                
                if(!cartItemExist) {
                    cartItems.push(item);
                }

                // change number of items in badge in header
                const badge = document.querySelector('.badge');
                const numOfItems = cartItems.length;
                badge.innerHTML = numOfItems;   

                // update session storage
                sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
            }

        }) // enc of event listener
    }) // end of buttons forEach

    // cartItem button animation on click
    const cartButtons = document.querySelectorAll('.cart-button');
    cartButtons.forEach(item => {
        item.addEventListener('click', cartClick);
    })

    function cartClick() {
        let button = this;
        button.classList.add('clicked');
    }
} else if (window.location.href.indexOf('shopping_cart_page_controler.php') >= 0) {

    // get products container
    const productsContainer = document.querySelector('.products');

    // get cartItems array from session Storage
    let cartItems = JSON.parse(sessionStorage.getItem("cartItems"));

    // for every cartItem in array make product element
    cartItems.forEach(item => {
        let product = document.createElement('div');
        product.classList.add('row');
        product.classList.add('bg-white');
        product.classList.add('mb-1');
        product.classList.add('py-3');

        product.innerHTML = `
                <div class="col-3"><img style="width: 50%;" src="${item.image}" alt="${item.name}" /></div>
                <div class="col-2">${item.name}</div>
                <div class="col-2">${item.price} x </div>
                <div class="col-2">
                    <input data-id="${item.id}" class="product-quantity" type="number" name="quantity-${item.id}" value="${item.quantity}" max="3" min="1" step="1" />
                </div>
                <div class="col-2"> = <span class="tpp total-product-price-${item.id}">${item.price}</span></div>
                <div class="col-1"><button data-id=${item.id} class='delete btn btn-dark text-white'>X</button></div>
                <input type="hidden" name="${item.id}" value="product-id">
                <input type="hidden" name="total_quantity-${item.id}" value="product-total-quantity-${item.stock}">
        `;

        productsContainer.appendChild(product);
    })

    // calculate total price
     let totalPrice = 0;
     const totalProductsPrices = document.querySelectorAll('.tpp');
     totalProductsPrices.forEach(price => {
        // need product quantity
        // let quantity = price.previousElementSibling.firstChild.value;

         totalPrice += +price.innerHTML;
     })

    // delete item on button click
    const deleteBtns = document.querySelectorAll('.delete')
    deleteBtns.forEach((button, index) => {
        button.addEventListener('click', e => {
            // also need to remove from sessionStorage 
            cartItems.forEach((item, index) => {
                const buttonDataId = button.getAttribute('data-id');
                if(item.id === buttonDataId) {
                    cartItems.splice(index, 1);
                }
                sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
                button.parentElement.parentElement.remove();
                // calculate total productS price
                let totalPrice = 0;
                const totalProductsPrices = document.querySelectorAll('.tpp');
                totalProductsPrices.forEach(price => {
                    totalPrice += +price.innerHTML;
                })
                // update total price UI
                let totalCost = document.querySelector('.total-cost');
                totalCost.innerHTML = totalPrice;
            })
        })
    })

    // update quantity on input change 
    const productQuantityInput = document.querySelectorAll('.product-quantity');
    productQuantityInput.forEach((input, index) => {
        input.addEventListener('change', e => {
            cartItems.forEach(item => {
                const inputDataId = input.getAttribute('data-id');
                if(inputDataId == item.id) {
                    item.quantity = input.value;
                    // update quantity in sessionStorage
                    cartItems.forEach(item => {
                        if(inputDataId == item.id) {
                            item.quantity = item.quantity;
                        }
                        sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
                    })
                    // calculate total product price
                    const totalProductPrice = item.quantity * item.price;
                    const totalProductPriceContainer = document.querySelector(`.total-product-price-${item.id}`);
                    totalProductPriceContainer.innerHTML = totalProductPrice; 
                    // calculate total productS price
                    let totalPrice = 0;
                    const totalProductsPrices = document.querySelectorAll('.tpp');
                    totalProductsPrices.forEach(price => {
                        totalPrice += +price.innerHTML;
                    })
                    // update total price UI
                    let totalCost = document.querySelector('.total-cost');
                    totalCost.innerHTML = totalPrice;
                    // get alert if there in not enough products in stock
                    if(item.quantity > item.stock) {
                        alert('update stock');
                    }
                }
            })
        })
    })

    // update total price UI
    let totalCost = document.querySelector('.total-cost');
    totalCost.innerHTML = totalPrice;

    // AUTOPLAY VIDEO - not working(change muted to 0 but video stop)
    // const video = document.querySelector('iframe');
    // let src = video.getAttribute('src');
    // let newSrc = src.slice(0, src.length - 1) + '0';
    // setTimeout(() => {
    //     video.setAttribute('src', newSrc);
    // }, 5000)
    
}
