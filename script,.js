var bm;
var feebbackModal;
var alertModal;
var k;
var ratemodal;

function goToHome() {
    window.location = "home.php";
}

function goToIndex() {
    window.location = "index.php";
}

function goToCart() {
    window.location = "cart.php";
}

function goToAddProduct() {
    window.location = "add_product.php";
}

function goToWatchlist() {
    window.location = "watchlist.php";
}

function goToProfile() {
    window.location = "userProfile.php";
}


function changeView() {

    var signInbox = document.getElementById("signInbox");
    var signUpbox = document.getElementById("signUpbox");

    signInbox.classList.toggle("d-none");
    signUpbox.classList.toggle("d-none");

}

function signUp() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var f = new FormData();

    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("mobile", mobile.value);
    f.append("gender", gender.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;



            if (text == "111") {
                changeView();
            } else {
                document.getElementById("msg").innerHTML = text;
            }
            alert(text);


        }

    }
    r.open("POST", "signUpProcess.php", true);
    r.send(f);


}

function signIn() {

    var email2 = document.getElementById("email2");
    var password2 = document.getElementById("password2");
    var remember = document.getElementById("remember");


    var formData1 = new FormData();
    formData1.append("email", email2.value);
    formData1.append("password", password2.value);
    formData1.append("remember", remember.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var t = r.responseText;

            if (t == "Success") {
                window.location = "home.php";
            } else if (t == "00X") {
                window.location = "blockedUser.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }

        }

    }

    r.open("POST", "signInProcess.php", true);
    r.send(formData1);



}

function fogotpassword() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {

                //alert("Verification email sent to your Email");
                var m = document.getElementById("fogetPasswordModle");
                var bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(text);
            }


        }
    };
    r.open("GET", "fogotPasswordrocess.php?e=" + email.value, true);
    r.send();

}


function resetPassword() {
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");
    var e = document.getElementById("email2");

    var form1 = new FormData();
    form1.append("np", np.value);
    form1.append("rnp", rnp.value);
    form1.append("vc", vc.value);
    form1.append("e", e.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                alert("Password Reset Sucsessfully Done");
                np.value = "";
                rnp.value = "";
                vc.value = "";
                bm.hide();
            } else {
                alert(text)
            }
        }
    }
    r.open("POST", "resetPassword.php", true);
    r.send(form1);

}

function showP1() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (npb.innerHTML == "Show") {
        np.type = "text";
        npb.innerHTML = "Hide";
    } else {
        np.type = "password";
        npb.innerHTML = "Show";
    }
}


function showP2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnpb.innerHTML == "Show") {
        rnp.type = "text";
        rnpb.innerHTML = "Hide";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "Show";
    }


}

function showPw() {
    var showPw = document.getElementById("showPw");
    var showPwB = document.getElementById("showPwB");

    if (showPwB.innerHTML == "Show") {
        showPw.type = "text";
        showPwB.innerHTML = "Hide";
    } else {
        showPw.type = "password";
        showPwB.innerHTML = "Show";
    }


}

function goToProduct() {


    window.location = "add_product.php"
}

function changeImg1() {
    var image = document.getElementById("imgUploader1");
    var view = document.getElementById("prev1");
    image.onchange = function() {

        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        //alert(url);
        view.src = url;
    }


}


function changeImg2() {
    var image = document.getElementById("imgUploader2");
    var view = document.getElementById("prev2");
    image.onchange = function() {

        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        //alert(url);
        view.src = url;
    }


}

function changeImg3() {
    var image = document.getElementById("imgUploader3");
    var view = document.getElementById("prev3");
    image.onchange = function() {

        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        //alert(url);
        view.src = url;
    }


}


function changeProfileImg() {
    var image = document.getElementById("profileImage");
    var view = document.getElementById("prev");
    image.onchange = function() {

        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        //alert(url);
        view.src = url;
    }


}


function addProduct() {




    var category = document.getElementById("ca");
    //alert(category.value);
    var brand = document.getElementById("br");
    //alert(brand.value);
    var modle = document.getElementById("mo");
    //alert(modle.value);
    var title = document.getElementById("ti");
    //alert(title.value);

    var condition;

    if (document.getElementById("bn").checked) {
        condition = "1";
        //condition = "Brand New";
    } else if (document.getElementById("us").checked) {
        condition = "2";
        //condition = "Used";
    }
    //alert(condition);

    var color;

    if (document.getElementById("clr1").checked) {
        color = "1";
    } else if (document.getElementById("clr2").checked) {
        color = "2";
    } else if (document.getElementById("clr3").checked) {
        color = "3";
    } else if (document.getElementById("clr4").checked) {
        color = "4";
    } else if (document.getElementById("clr5").checked) {
        color = "5";
    } else if (document.getElementById("clr6").checked) {
        color = "6";
    }
    //alert(color);


    var qty = document.getElementById("qty");
    //alert(qty.value);
    var cost = document.getElementById("cost");
    //alert(cost.value);
    var dilivery_within_colombo = document.getElementById("dwc");
    //alert(dilivery_within_colombo.value);
    var dilivery_out_of_colombo = document.getElementById("doc");
    //alert(dilivery_out_of_colombo.value);
    var description = document.getElementById("des");
    //alert(description.value);


    var image = document.getElementById("imgUploader1");
    //alert(imgUploader.value);

    var image2 = document.getElementById("imgUploader2");

    var image3 = document.getElementById("imgUploader3");
    //alert();
    // var = document.getElementById("");
    // var = document.getElementById("");

    var form = new FormData();
    form.append("c", category.value);
    form.append("b", brand.value);
    form.append("m", modle.value);
    form.append("t", title.value);
    form.append("co", condition);
    form.append("clr", color);
    form.append("p", cost.value);
    form.append("qty", qty.value);
    form.append("dwc", dilivery_within_colombo.value);
    form.append("doc", dilivery_out_of_colombo.value);
    form.append("des", description.value);

    form.append("img", image.files[0]);
    form.append("img2", image2.files[0]);
    form.append("img3", image3.files[0]);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var rtext = r.responseText;

            if (rtext == "000") {
                setTimeout(function() { window.location = "add_product.php" }, 2000);

                alert("Product Regesterd SuccessFully");
            } else {
                alert(rtext);

            }
        }

    }
    r.open("POST", "addProductProcess.php", true);
    r.send(form);


}




function updateProduct() {

    var title = document.getElementById("ti");
    //alert(title.value);
    var qty = document.getElementById("qty");
    //alert(qty.value);
    var dilivery_within_colombo = document.getElementById("dwc");
    //alert(dilivery_within_colombo.value);
    var dilivery_out_of_colombo = document.getElementById("doc");
    //alert(dilivery_out_of_colombo.value);
    var description = document.getElementById("des");
    //alert(description.value);
    var image = document.getElementById("imgUploader1");
    //alert(imgUploader.value);

    var image2 = document.getElementById("imgUploader2");

    var image3 = document.getElementById("imgUploader3");



    //alert(image);

    var form = new FormData();
    form.append("t", title.value);
    form.append("qty", qty.value);
    form.append("dwc", dilivery_within_colombo.value);
    form.append("doc", dilivery_out_of_colombo.value);
    form.append("des", description.value);

    form.append("img", image.files[0]);
    form.append("img2", image2.files[0]);
    form.append("img3", image3.files[0]);




    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var rtext = r.responseText;


            if (rtext == "000") {

                //alert();
                title.value = "";
                qty.value = "";
                dilivery_out_of_colombo.value = "";
                dilivery_within_colombo.value = "";
                description.value = "";

                var alertModal0 = document.getElementById("alertModal0");
                var alertModal = new bootstrap.Modal(alertModal0);

                document.getElementById("alertModal0_title").innerHTML = "Product Updated";
                document.getElementById("alertModal0_body").innerHTML = "Product Updated SuccessFully";
                alertModal.show();

                setTimeout(function() { alertModal.hide() }, 5000);


            } else {
                alert(rtext);
            }
        }

    }
    r.open("POST", "updateProductProcess.php", true);
    r.send(form);


}

function signOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {


        var t = r.responseText;
        if (t == "01") {
            window.location = "home.php";
        }
    }
    r.open("GET", "signOut.php", true);
    r.send();
}


// function changeProductView() {
//     var add = document.getElementById("addProductBox");
//     var upd = document.getElementById("updateProductBox");

//     add.classList.toggle("d-none");
//     upd.classList.toggle("d-none");
// }

function updateProfile() {


    alert();
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("city");
    var profileImage = document.getElementById("profileImage");


    var f = new FormData();
    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("m", mobile.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("c", city.value);
    f.append("i", profileImage.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;


            if (t == "00x") {
                window.location = "index.php";
            } else if (t == "009") {
                window.location = "userProfile.php";
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);


}


function changeState(id) {

    var productId = id;
    var checkId = "check" + id;
    var statusCheck = document.getElementById(checkId);

    var status;

    if (statusCheck.checked) {
        status = 1;
    } else {
        status = 0;
    }

    alert(productId, status)

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);

            var activeORdeavtive = document.getElementById("checklable" + id);

            if (t == "deactivated") {
                activeORdeavtive.innerHTML = "Make your product active";
            } else if (t == "activated") {
                activeORdeavtive.innerHTML = "Make your product Deactive";
            }

        }
    }
    r.open("GET", "statusChangeProcess.php?p=" + productId + "&s=" + status, true);
    r.send();

}


function deleteModal(id) {

    var dm = document.getElementById("deleteModal" + id);
    m = new bootstrap.Modal(dm);
    m.show();


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {
            var t = request.responseText;
            alert(t);
        }
    }
    request.open("GET", "deleteProductProcess.php?id=" + id, true);
    request.send();

}

function addFilters(x) {

    var search = document.getElementById("search");

    var age;
    var qty;
    var con;

    if (document.getElementById("n").checked) {

        age = 1;

    } else if (document.getElementById("o").checked) {
        age = 2;
    } else {
        age = 0;
    }

    if (document.getElementById("l").checked) {

        qty = 1;

    } else if (document.getElementById("h").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    if (document.getElementById("b").checked) {

        con = 1;

    } else if (document.getElementById("u").checked) {
        con = 2;
    } else {
        con = 0;
    }


    // alert(search.value);
    //alert(age);
    //alert(qty);
    //alert(con);

    var f = new FormData();
    f.append("page", x);
    f.append("s", search.value);
    f.append("a", age);
    f.append("q", qty);
    f.append("c", con);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {
            var t = request.responseText;
            //alert(t);
            myproducts
            document.getElementById("productview").innerHTML = t;
            document.getElementById("myproducts").className = "d-none";
            document.getElementById("pagination").className = "d-none";

            //var obj = JSON.stringify(t)
            //alert(obj);
            //var len = Object.keys(obj).length;
            //alert(len);
            /*var arr = JSON.parse(t);
            var length = Object.keys(arr).length;
            alert(length);
            for (var i = 0; i < arr.length; i++) {
                var row = arr[i];
                alert(row["title"]);
            }*/
        }
    }
    request.open("POST", "filterProcess.php", true);
    request.send(f);


}

function searchToUpdate() {

    var id = document.getElementById("searchToUpdate").value;
    var caSelected = document.getElementById("caSelected");


    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {
            var t = request.responseText;
            alert(t);
            var Object = JSON.parse(t);
            cc = Object["catagory"];
            alert(cc);
            alert(Object["catagory"]);
            caSelected.innerHTML = cc;



        }
    }
    request.open("GET", "searchToUpdateProcess.php?id=" + id, true);
    request.send();

}


function sendId(id) {

    var id = id;

    //alert(id);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);

            if (t == "000") {
                window.location = "updateProduct.php"
            }
        }
    }
    r.open("GET", "sendProductProcess.php?id=" + id, true);
    r.send();


}

//// Img loading /////

function loadMainImg(x) {
    //alert(document.getElementById(x).src);
    //var pid = x.src;
    //alert(pid);
    var img = document.getElementById(x).src;
    var maining = document.getElementById("maining");

    maining.src = img;

}

//// qty update  /////

function qty_inc(qty) {


    //alert();

    var pqty = qty;

    var input = document.getElementById("qtyInput");


    if (input.value < pqty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();

    } else {
        alert("Maximum quantity count has been achived");
    }

}


function qty_inc2(qty, id) {


    //alert();

    var pqty = qty;

    var input = document.getElementById("qtyInput" + id);


    if (input.value < pqty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();

    } else {
        alert("Maximum quantity count has been achived");
    }

}


function qty_dec() {


    //alert();

    //var pqty = qty;

    var input = document.getElementById("qtyInput");


    if (input.value >= 2) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();

    } else {
        alert("Minimum quantity count has been achived");
    }

}

function qty_dec2(id) {


    //alert();

    //var pqty = qty;

    var input = document.getElementById("qtyInput" + id);


    if (input.value >= 2) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();

    } else {
        alert("Minimum quantity count has been achived");
    }

}

/*
function basicSearch() {

    var basic_search_txt = document.getElementById("basic_search_txt").value;
    var cat_s = document.getElementById("cat_s").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text)
            var ar = JSON.parse(text);
            var hi = ar["title"];
            alert(hi);

        }
    }
    r.open("GET", "basicSearchProcess.php?basic_search_txt=" + basic_search_txt + "&cat_s=" + cat_s, true);
    r.send();

}*/

function basicSearch(x) {

    var page = x;
    var searchText = document.getElementById("basic_search_txt").value;
    var searchSelect = document.getElementById("cat_s").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);
            if (t == "empty") {
                window.location = "home.php";
            } else {
                document.getElementById("product_view_div").innerHTML = t;
            }
        }
    }

    r.open("GET", "basicSearchProccess.php?t=" + searchText + "&s=" + searchSelect + "&p=" + page, true);
    r.send();
}

function addToWatchlist(x) {

    var id = x;
    //alert(id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var rtext = r.responseText;


            if (rtext == "000") {
                alert("Product added to Watchlist");
                document.getElementById("watch" + id).className = "bi bi-heart fs-1 text-danger";
            } else if (rtext == "001") {
                alert("Please Log in");
                window.location = "index.php";
            } else {
                alert(rtext);
            }
        }

    }
    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();
}

function deleteFromWatchlist(x) {
    var id = x;
    //alert(id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "000") {

                //alert();
                var alertModal0 = document.getElementById("alertModal0");
                var alertModal = new bootstrap.Modal(alertModal0);

                document.getElementById("alertModal0_title").innerHTML = "Product Removed from Watchlist";
                document.getElementById("alertModal0_body").innerHTML = "Product removed SuccessFully from Watchlist";
                alertModal.show();
                setTimeout(function() { window.location = "watchlist.php" }, 5500);
                setTimeout(function() { alertModal.hide() }, 5000);

            } else {
                alert(t)

            }
        }
    }

    r.open("GET", "removeFromWatchlist.php?id=" + id, true);
    r.send();

}

function addToCart(x) {

    var id = x;
    var qtyTxt = document.getElementById("qtyTxt" + id).value

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var rtext = r.responseText;
            // alert(rtext);

            if (rtext == "000") {
                alert("Product SucessFully Added to cart");
            } else if (rtext == "00X") {
                alert("You must Sign in to Add produts to cart");
                goToIndex();
            } else {
                alert(rtext);

            }
        }

    }
    r.open("GET", "addToCartProcess.php?id=" + id + "&qtyTxt=" + qtyTxt, true);
    r.send();



}



function addToCart2(x) {

    var id = x;
    var qtyTxt = document.getElementById("qtyInput").value

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var rtext = r.responseText;
            alert(rtext);

            if (rtext == "000") {

            }
        }

    }
    r.open("GET", "addToCartProcess.php?id=" + id + "&qtyTxt=" + qtyTxt, true);
    r.send();



}


function deleteFromCart(x) {
    var id = x;
    // alert(id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t)

            if (t == "000") {

                //alert();
                var alertModal0 = document.getElementById("alertModal0");
                var alertModal = new bootstrap.Modal(alertModal0);

                document.getElementById("alertModal0_title").innerHTML = "Product Removed from Cart";
                document.getElementById("alertModal0_body").innerHTML = "Product removed SuccessFully from Cart";
                alertModal.show();
                setTimeout(function() { window.location = "cart.php" }, 5500);
                setTimeout(function() { alertModal.hide() }, 5000);





            }
        }
    }

    r.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    r.send();
}

//payNow
function payNow(x) {

    //alert();

    var id = x;
    var qty = document.getElementById("qtyInput").value;

    //alert(id + qty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            //alert(text);
            if (text == "x0x") {
                alert("please Sign in");
                window.location = "index.php";
            } else if (text == "002") {
                alert("Please Enter Update your profile first");
                window.location = "userProfile.php";
            } else {

                var obj = JSON.parse(text);

                var userEmail = obj["email"];
                //alert(userEmail);
                var amount = obj["amount"];
                //alert(amount);
                //var qty1 = obj["qty"];
                //alert(qty1);
                //alert(userEmail);


                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, userEmail, amount, qty);
                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                    alert("Payment Dissmissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1217863", // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/singleproductview.php?id=" + id, // Important
                    "cancel_url": "http://localhost/eshop/singleproductview.php?id=" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": obj["amount"],
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": obj["email"],
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["districtName"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["districtName"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                //document.getElementById('payhere-payment').onclick = function(e) {
                payhere.startPayment(payment);
                //};

            }
        }

    }
    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();



}


//save Invoice

function saveInvoice(order_id, id, mail, amount, qty) {

    var order_id = order_id;
    var pid = id;
    var email = mail;
    var total = amount;
    var qty1 = qty;

    //alert(order_id);
    alert(pid);
    //alert(email);
    //alert(total);

    var f = new FormData();
    f.append("order_id", order_id);
    f.append("pid", pid);
    f.append("email", email);
    f.append("total", total);
    f.append("qty", qty1);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "000") {
                window.location = "invoice.php?id=" + order_id;
            } else {
                alert(text);
            }


        }

    }
    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}

function detailsmodal(x) {
    alert(x);
    var id = x;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            var alertModal0 = document.getElementById("alertModal0");
            var alertModal = new bootstrap.Modal(alertModal0);

            document.getElementById("alertModal0_title").innerHTML = "ProductDetails";
            document.getElementById("alertModal0_body").innerHTML = t;
            alertModal.show();

        }
    }

    r.open("GET", "productDetails.php?id=" + id, true);
    r.send();

}

function printDiv() {
    var divContents = document.getElementById("GFG").innerHTML;
    var a = window.open('', '', 'height=500, width=500');
    a.document.write('<html>');

    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
}

function feedback(id) {
    alert(id);
    var feebbackId = document.getElementById("feebbackModal" + id);
    feebbackModal = new bootstrap.Modal(feebbackId);
    feebbackModal.show();
}

function saveFeedback(id) {

    var pid = id;
    var feedback = document.getElementById("feedtext" + pid).value;

    alert(pid + feedback);

    f = new FormData();
    f.append("id", pid);
    f.append("txt", feedback);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {

        if (request.readyState == 4) {
            var t = request.responseText;
            alert(t);
        }
    }
    request.open("POST", "saveFeedbackProcess.php", true);
    request.send(f);

}

function adminVerification() {
    alert();
}

// function blockUser(x) {

//     var mail = x;
//     f = new FormData();
//     f.append("e", mail);

//     var request = new XMLHttpRequest();
//     request.onreadystatechange = function() {

//         if (request.readyState == 4) {
//             var t = request.responseText;
//             alert(t);
//         }
//     }
//     request.open("POST", "userBlockProcess.php", true);
//     request.send(f);


// }





function adminverification() {


    var e = document.getElementById("e").value;
    //alert(e);
    var r = new XMLHttpRequest();

    var f = new FormData();
    f.append("e", e);

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);
            if (t == "000") {

                var verificatiomodal = document.getElementById("verificatiomodal");

                k = new bootstrap.Modal(verificatiomodal);

                k.show();


            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminverificationproccess.php", true);
    r.send(f);

}


function verify() {

    //alert();
    var verificationcode = document.getElementById("v").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                window.location = "admin.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "verificationprocess.php?v=" + verificationcode, true);
    r.send();
}


function dailyselling() {
    var from = document.getElementById("fromdate").value;
    var to = document.getElementById("todate").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                alert("Please enter From Date");
            } else if (t == 2) {
                alert("Please enter To Date");
            } else if (t == 3) {
                alert("Please enter From date & To date correctly");
            } else {
                window.location = "sellinghistory.php?f=" + from + "&t=" + to;
            }
        }
    }

    r.open("GET", "dailySellingProcess.php?f=" + from + "&t=" + to, true);
    r.send();
}

function blockUser(x) {

    var mail = x;
    var blockbtn = document.getElementById("btn" + mail);


    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "000") {
                alert("USER BLOKED");
                window.location = "manageUsers.php";
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock"

            } else if (t == "001") {
                alert("USER UNBLOKED");
                window.location = "manageUsers.php";
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block"

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "userBlockProcess.php", true);
    r.send(f);
}


//viewmsgmodal



//searchUser

function searchUser() {
    alert();
    var text = document.getElementById("searchtext").value;
    var table = document.getElementById("table");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t)
            if (t == "empty") {
                alert("Please add a name to search.");
            } else {
                table.innerHTML = t;
            }
        }
    }

    r.open("GET", "searchuser.php?s=" + text, true);
    r.send();
}



function blockproduct(id) {
    var id = id;
    var blockbtn = document.getElementById("blockbtn" + id);

    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success1") {
                alert("Product Bloked");
                window.location = "manageProducts.php";
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock"
            } else if (t == "success2") {
                alert("Product Unbloked");
                window.location = "manageProducts.php";
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block"
            }
        }
    }

    r.open("POST", "productBlockProcess.php", true);
    r.send(f);
}



function singleviewmodal(id) {
    var pop = document.getElementById("singleproductview" + id);

    k = new bootstrap.Modal(pop);
    k.show();
}

function addnewmodal() {
    var pop = document.getElementById("addnewmodal");

    k = new bootstrap.Modal(pop);
    k.show();
}

function savecategory() {
    //alert();

    var txt = document.getElementById("categorytxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "000") {
                k.hide();
                alert("Category saved successfully.");
                window.location = "manageProducts.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addNewcategoryProcess.php?t=" + txt, true);
    r.send();

}


function addFeedback(id) {

    var feedmodel = document.getElementById("feedbackModal" + id);
    k = new bootstrap.Modal(feedmodel);
    k.show();

}

//save feedback

function saveFeedback(id) {
    var pid = id;
    var feedtxt = document.getElementById("feedtxt").value;

    var f = new FormData();
    f.append("i", pid);
    f.append("ft", feedtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                k.hide();
            }
        }
    }

    r.open("POST", "savefeedbackProccess.php", true);
    r.send(f);
}






// sendmessage


function viewmsgmodal(x) {
    //alert(x);
    var pop = document.getElementById("msgModal");


    k = new bootstrap.Modal(pop);
    document.getElementById("modalName").innerHTML = x;
    k.show();
}


function sendmessage(mail, ad) {
    //alert(ad);
    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;
    document.getElementById("msgtxt").value = "";



    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);
    var ad = ad;
    if (ad != null) {
        f.append("ad", ad);
        //alert(ad);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                alert("Message Sent Successfully");

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendmessageprocess.php", true);
    r.send(f);

}


// refresher

function refresher(email, ad) {

    setInterval(function() {
        refreshmsgare(email, ad);
        refreshrecentarea();
        var elem = document.getElementById('chatrow');
        // elem.scrollTop = elem.scrollHeight;
    }, 500);

}



// refres msg view area

function refreshmsgare(mail, ad) {
    //alert();
    var chatrow = document.getElementById("chatrow");

    var f = new FormData();
    f.append("e", mail);
    if (ad != null) {
        f.append("ad", ad);
        //alert(ad);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);
            chatrow.innerHTML = t;
        }
    }

    r.open("POST", "refreshmsgareaprocess.php", true);
    r.send(f);

}

// refreshrecentarea

function refreshrecentarea() {

    var rcv = document.getElementById("rcv");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;
            //alert(t);
        }
    }

    r.open("POST", "refreshrecentareaprocess.php", true);
    r.send();

}



function advanceSearch(txt, ss, pn) {

    var s;
    var c;
    var b;
    var m;
    var con;
    var col;
    var pfrom;
    var pto;
    var sort;
    var pn;

    if (txt == undefined && ss == undefined && pn == undefined) {
        s = document.getElementById("s").value;
        c = document.getElementById("c").value;
        b = document.getElementById("b").value;
        m = document.getElementById("m").value;
        con = document.getElementById("con").value;
        col = document.getElementById("col").value;
        pfrom = document.getElementById("pfrom").value;
        pto = document.getElementById("pto").value;
        sort = document.getElementById("sort").value;
        pn = 1;
    } else {
        document.getElementById("s").value = txt;
        pn = pn;

        s = txt;
        c = "0";
        b = "0";
        m = "0";
        con = "0";
        col = "0";
        pfrom = "";
        pto = "";
        sort = "1";


        sel = ss.split("-");

        if (sel[0] == 0) {
            //Do nothing
        } else if (sel[0] == 1) {
            document.getElementById("c").value = sel[2];
            c = sel[2];
        } else if (sel[0] == 2) {
            document.getElementById("b").value = sel[2];
            b = sel[2];
        } else if (sel[0] == 3) {
            document.getElementById("m").value = sel[2];
            m = sel[2];
        } else if (sel[0] == 4) {
            document.getElementById("con").value = sel[2];
            con = sel[2];
        } else if (sel[0] == 5) {
            document.getElementById("col").value = sel[2];
            col = sel[2];
        } else if (sel[0] == 6) {
            document.getElementById("pfrom").value = sel[2];
            pfrom = sel[2];
        } else if (sel[0] == 7) {
            document.getElementById("pto").value = sel[2];
            pto = sel[2];
        } else if (sel[0] == 8) {
            document.getElementById("pfrom").value = sel[2];
            document.getElementById("pto").value = sel[3];
            pfrom = sel[2];
            pto = sel[3];
        }

        if (sel[1] == 1) {
            document.getElementById("sort").value = sel[1];
            sort = sel[1];
        } else if (sel[1] == 2) {
            document.getElementById("sort").value = sel[1];
            sort = sel[1];
        } else if (sel[1] == 3) {
            document.getElementById("sort").value = sel[1];
            sort = sel[1];
        } else if (sel[1] == 4) {
            document.getElementById("sort").value = sel[1];
            sort = sel[1];
        }
    }

    var f = new FormData();
    f.append("s", s);
    f.append("c", c);
    f.append("b", b);
    f.append("m", m);
    f.append("con", con);
    f.append("col", col);
    f.append("pf", pfrom);
    f.append("pt", pto);
    f.append("st", sort);
    f.append("pn", pn);

    var a = new XMLHttpRequest();

    a.onreadystatechange = function() {
        if (a.readyState == 4) {
            var text = a.responseText;
            // alert(text);

            // document.getElementById("resultbox").innerHTML = text;

            if (text == "no") {
                document.getElementById("resultbox").innerHTML = "<h2 class='text-white fw-bold text-center'>No Products Found</h2>";
            } else if (text == "empty") {
                document.getElementById("resultbox").innerHTML = "<h2 class='fw-bold text-white text-center'>You must enter a keyword to search</h2>";
            } else {
                var cont = text.split("<hr/><hr/><hr/><hr/><hr/>");
                // alert(cont[0]);
                document.getElementById("resultbox").innerHTML = cont[0];
                document.getElementById("pagbox").innerHTML = cont[1];
                // alert(cont[1]);
            }

        }
    }

    a.open("POST", "advanceSearchProcess.php", true);
    a.send(f);

}

function req(id) {

    var id = id;

    //alert(id);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);

            if (t == "00X") {
                window.location = "index.php";
            } else if (t == "000") {
                alert("Successfully Requested from admins");

            } else if (t == "002") {
                alert("you have already reqested this Product");
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "req.php?pid=" + id, true);
    r.send();


}

function checkOut() {

    var check = document.getElementById("checkBtn");
    //alert(check.value);

    const ids1 = [];
    const qty1 = [];

    for (let index = 0; index < check.value; index++) {
        //alert(document.getElementById("btn" + index).value);

        ids1[index] = document.getElementById("btn" + index).value;
    }

    for (let index = 0; index < check.value; index++) {

        qty1[index] = document.getElementById("qtyInput" + ids1[index]).value;
    }

    //alert(ids1);
    //alert(qty1);

    var f = new FormData();
    f.append("idx", ids1);
    f.append("qtyx", qty1);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            // /alert(t);

            if (t == "0X0") {
                window.location = "index.php";
            } else if (t == "001") {
                window.location = "userProfile.php";
            } else {
                //alert();
                var obj = JSON.parse(t);

                var orderId = obj["id"];
                var userEmail = obj["email"];
                var amount = obj["amount"];
                var prod = obj["prods"];
                var prodQty = obj["prodQty"]



                //alert(amount);               
                //alert(userEmail);
                //alert(prod);
                //alert(prodQty);


                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveBill(orderId, userEmail, amount, prod, prodQty);
                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                    alert("Payment Dissmissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1217863", // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/cart.php", // Important
                    "cancel_url": "http://localhost/eshop/cart.php", // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": obj["amount"],
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": obj["email"],
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["districtName"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["districtName"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                //document.getElementById('payhere-payment').onclick = function(e) {
                payhere.startPayment(payment);
                //};
            }

        }
    }
    r.open("POST", "checkOut.php", true);
    r.send(f);

}

function saveBill(order_id, mail, amount, prod, prodQty) {

    var order_id = order_id;
    var email = mail;
    var total = amount;
    var prod = prod;
    var prodQty = prodQty;


    //alert(order_id);
    //alert(email);
    //alert(total);

    var f = new FormData();
    f.append("order_id", order_id);
    f.append("email", email);
    f.append("total", total);
    f.append("prod", prod);
    f.append("prodQty", prodQty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
            if (text == "000") {
                window.location = "invoice1.php?id=" + order_id;
            }


        }

    }
    r.open("POST", "saveBill.php", true);
    r.send(f);

}

function msg(x) {
    window.location = "messagesA.php?e=" + x;
}

function rate(x) {
    //alert(x);

    var ratemodal = document.getElementById("ratemodal" + x);
    ratemodal = new bootstrap.Modal(ratemodal);

    var x = x;

    if (x == 0) {
        ratemodal.hide();
    } else {
        ratemodal.show();

    }
}

function colorStar(x, y) {

    var st1 = document.getElementById("st1" + y);
    var st2 = document.getElementById("st2" + y);
    var st3 = document.getElementById("st3" + y);
    var st4 = document.getElementById("st4" + y);
    var st5 = document.getElementById("st5" + y);



    if (x == 1) {
        st1.className = "bi bi-star-fill me-2 fs-1 text-warning";
    } else if (x == 2) {
        st1.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st2.className = "bi bi-star-fill me-2 fs-1 text-warning";
    } else if (x == 3) {
        st1.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st2.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st3.className = "bi bi-star-fill me-2 fs-1 text-warning";


    } else if (x == 4) {
        st1.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st2.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st3.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st4.className = "bi bi-star-fill me-2 fs-1 text-warning";


    } else if (x == 5) {
        st1.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st2.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st3.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st4.className = "bi bi-star-fill me-2 fs-1 text-warning";
        st5.className = "bi bi-star-fill me-2 fs-1 text-warning";

    }

}

function resetstar(x, y) {
    var st1 = document.getElementById("st1" + y);
    var st2 = document.getElementById("st2" + y);
    var st3 = document.getElementById("st3" + y);
    var st4 = document.getElementById("st4" + y);
    var st5 = document.getElementById("st5" + y);



    if (x == 1) {
        st1.className = "bi bi-star-fill me-2 fs-1";
    } else if (x == 2) {
        st1.className = "bi bi-star-fill me-2 fs-1";
        st2.className = "bi bi-star-fill me-2 fs-1";
    } else if (x == 3) {
        st1.className = "bi bi-star-fill me-2 fs-1";
        st2.className = "bi bi-star-fill me-2 fs-1";
        st3.className = "bi bi-star-fill me-2 fs-1";


    } else if (x == 4) {
        st1.className = "bi bi-star-fill me-2 fs-1";
        st2.className = "bi bi-star-fill me-2 fs-1";
        st3.className = "bi bi-star-fill me-2 fs-1";
        st4.className = "bi bi-star-fill me-2 fs-1";


    } else if (x == 5) {
        st1.className = "bi bi-star-fill me-2 fs-1";
        st2.className = "bi bi-star-fill me-2 fs-1";
        st3.className = "bi bi-star-fill me-2 fs-1";
        st4.className = "bi bi-star-fill me-2 fs-1";
        st5.className = "bi bi-star-fill me-2 fs-1";

    }
}


function saverate(x, y) {


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "001") {
                alert("ratings updated Successfully");
            } else if (t == "000") {
                alert("ratings added Successfully");
            } else {
                alert(t);
            }

            rate(0);

        }
    }
    r.open("GET", "rate.php?r=" + x + "&id=" + y, true)
    r.send();



}