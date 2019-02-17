let image = {
    files : [],
    iterator : 0,

    read : (files) => {

        if (files) {
            $.each(files, (key,value) => {
               image.files.push(value);
                let reader = new FileReader();
                reader.onload = function() {
                    image.viewImage(reader.result);
                };
                reader.readAsDataURL(value);
            });
        }
    },

    viewImage : (img) => {
            imgBlock = `<div class="store_img d-inline-block mb-5"  data-id="${image.iterator++}">
                            <a role="button" class="deleteImage"><i class="fas fa-times"></i></a>
                            <img src="${img}" alt="Product Photo"> 
                        </div>`;
        $(`.file`).after(imgBlock);
    },

    uploadData : (form,params) => {
        let formData = new FormData(form),
            images = image.files.filter((el) => el);

        formData.delete('file[]');

        $.each(images, (key,val) => {
            formData.append('file[]',val);
        });

        $.ajax({
            url : `store-product?store=${params}`,
            data : formData,
            type : 'POST',
            success : (data) => {
                data  = JSON.parse(data);

                if(data['error']) {
                    image.generateError(data['error']);
                    return false;
                }else if (data['warning']) {
                    toastr.warning(data['warning']);
                    return false;
                }
                window.location.href = 'http://mvc.loc/product?product=my';
            },
            contentType : false,
            processData : false,
        });

    },

    generateError : (errors) => {
        toastr.error('Fix Errors');
        $.each(errors,(field,error) => {
            let errorBlock = `<span class="text-danger small errorBlock">${error}</span>`;
            $(`#${field}`).after(errorBlock);
        });
    },

    deleteImage : (elem) =>  {
       let elemId = elem.attr('data-id'),
           images = image.files;
       delete images[elemId];
       elem.remove();
       if(!images.filter((el) => el).length) $(`[type=file]`).val('');
    }

};
//CHANGE INPUT FILE
let fileInput = document.getElementById('file');
if(fileInput) {
    fileInput.addEventListener('change', function (event) {
        image.read(event.target.files);
        // let file = new File([''],'default.jpg',{type: 'image/jpg'});
        // let reader = new FileReader();
        // reader.onload = function() {
        //     console.log(reader.result);
        // };
        // reader.readAsDataURL(file);
    });
}
//DELETE ERROR BLOCK
$(document).on('keyup','.form-control',(e) => {
    let errorBlock = $(e.target).closest(`.form-group`).find(`.errorBlock`);
    if(errorBlock) errorBlock.remove();
});
//FOR SUBMIT
$(`.form`).on(`submit`,(e) => {
    e.preventDefault();
    let errorBlock = $(`.errorBlock`);
    if(errorBlock) errorBlock.remove();
    let params = $(e.target).find(`button`).attr(`data-param`);
    image.uploadData($(e.target)[0],params);
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
                window.location.href = 'http://mvc.loc/product=my';
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
