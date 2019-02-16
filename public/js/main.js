let image = {
    files : [],
    request : new XMLHttpRequest(),
    i : 0,

    read : (files) => {
        if (files) {
            $.each(files, (key,value) => {
                let reader = new FileReader();
                reader.onload = function() {
                    image.files.push(value);
                    image.viewImage(reader.result);
                };
                reader.readAsDataURL(value);
            });
        }
    },

    viewImage : (img) => {
            imgBlock = `<div class="store_img d-inline-block mb-5"  data-id="${image.i++}">
                            <a role="button" class="deleteImage"><i class="fas fa-times"></i></a>
                            <img src="${img}" alt="Product Photo"> 
                        </div>`;
        $(`.file`).after(imgBlock);
    },

    uploadFile : (form) => {
      let formData = new FormData(form);
      $.each(image.files, (key,value) => {
          formData.append('files[]',value);
      });

      image.request.open('post','store-product');
      image.request.send(formData);

    },

    deleteImage : (elem) =>  {
        let formData = new FormData($('.form')[0]);
        console.log(formData);
        // let elemId = elem.attr(`data-id`);
        // (image.files).splice(elemId,1);
        elem.remove();
    }

};
//CHANGE INPUT FILE
let fileInput = document.getElementById('file');
fileInput.addEventListener('change', function (event) {
    image.read(event.target.files);
});
//FOR SUBMIT
let form = document.querySelector('form');
let request = new XMLHttpRequest();
form.addEventListener('submit', function(e) {
    e.preventDefault();
    // image.uploadFile(e.target);
    let files = document.querySelector('[type=file]').files;
    let formData = new FormData(e.target);

    for (let i =0; i < files.length;i++) {
        let file = files[i];
        formData.append('file',file);
    }
    for (let val of formData.values()) {
        console.log(val);
    }

    request.open('post','store-product');
    request.send(formData);
});
//DELETE IMAGE
$(document).on('click','.deleteImage', function ()  {
    let elem = $(this).parent('.store_img');
    image.deleteImage(elem);
});
//DELETE PRODUCT
$(document).on('click','.delete', function ()  {
    let url = $(this).attr('data-action'),
        cond = confirm("Do you want to delete this product?");

    if(cond) {
        $.ajax({
            url : url,
            async : false,
            success : () => {
                window.location.href = 'http://mvc.loc/profile';
            },
            error : (err) => {
                console.error(err);
            }
        });
    }
} );


// Accordion
function myFunction(id) {
    let x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    let x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
