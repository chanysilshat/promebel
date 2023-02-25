document.addEventListener("DOMContentLoaded", function(){
    var form = document.querySelector(".inquiry-form");
    var action = form.getAttribute("data-action");
    var input = form.querySelector(".js__search");

    let oninput = false;
    let timer = null;

    input.addEventListener('input', function(){
        oninput = true;
        clearTimeout(timer)
        timer = setTimeout(() => {
            console.log("Delayed for 1 second.");
            oninput = false;
            if (!oninput){
                sendQueryAjaxQuery(form, action);
            }
        
          }, 1500)
    })

})

function sendQueryAjaxQuery(form ,action){
    let formData = new FormData(form);
    //formData.append('filter', this.value)
    let xhr = new XMLHttpRequest();
    xhr.open("POST", action);
    xhr.responseType = 'html';
    xhr.send(formData);
    xhr.onprogress = () => {
        document.querySelector('.inquiry-result').innerHTML="Идёт загрузка";
    }
    xhr.onload = (response) => {
        document.querySelector('.inquiry-result').innerHTML = xhr.response;
        $('.recommend-panel-slider').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            vertical: false,
            dots: true,
            arrows: false,
        });
        
    }
}