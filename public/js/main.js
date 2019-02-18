class Data
{
    constructor() {
        this.files = [];
        this.iterator = 0;
        this.tableImage = [];
    }

    readFile (files)  {
        if (files) {
            $.each(files, (key,value) => {
                this.files.push(value);
                let reader = new FileReader();
                reader.onload = function() {
                    data.showImage(reader.result);
                };
                reader.readAsDataURL(value);
            });
        }
    }

    uploadData (form,params)  {
        let formData = new FormData(form);

        if(this.files.length !== 0) {
            let images = data.files.filter((el) => el);
            formData.delete('file[]');

            $.each(images, (key,val) => {
                formData.append('file[]',val);
            });

            if(this.tableImage.length !== 0) {
                $.each(data.tableImage,(key,image) => {
                    formData.append('tableImage[]',image);
                });
            }
        }

        $.ajax({
            url : params,
            data : formData,
            type : 'post',
            success : (data) => {
                if(data) {
                    data  = JSON.parse(data);
                    if(data['error']) {
                        this.generateError(data['error']);
                        return false;
                    }else if (data['warning']) {
                        toastr.warning(data['warning']);
                        return false;
                    }else if(data['message']) {
                        toastr.info(data['message']);
                        return true;
                    }else if(data['link']) window.location.href = `http://mvc.loc/${data['link']}`;

                }
            },
            contentType : false,
            processData : false,
        });

    }

    showImage  (img)  {
        let imgBlock = `<div class="store_img d-inline-block mb-5"  data-id="${this.iterator++}">
                            <a role="button" class="deleteImage"><i class="fas fa-times"></i></a>
                            <img src="${img}" alt="Product Photo"> 
                        </div>`;
    $(`.file`).after(imgBlock);
    }

    generateError (errors)  {
        toastr.error('Fix Errors');
        $.each(errors,(field,error) => {
            let errorBlock = `<span class="text-danger small errorBlock">${error}</span>`;
        $(`#${field}`).after(errorBlock);
        });
    }

    deleteImage (elem)   {
        let elemId = elem.attr('data-id'),
            images = this.files,
            _tableImage = elem.closest(`.store_img`).attr(`data-name`);

        if(_tableImage) {
           this.tableImage.push(_tableImage);
        }else delete images[elemId];

        elem.remove();
        if(!images.filter((el) => el).length) $(`[type=file]`).val('');
    }

    deleteProduct (url) {
        let cond = confirm("Do you want to delete this product?");

        if(cond) {
            $.ajax({
                url : url,
                async : false,
                success : () => {
                    window.location.href = 'http://mvc.loc/product=all';
                },
                error : (err) => {
                    console.error(err);
                }
            });
        }
    }
    
}

let data = new Data();

//CHANGE INPUT FILE
let fileInput = document.getElementById('file');
if(fileInput) {
    fileInput.addEventListener('change', function (event) {
        data.readFile(event.target.files);
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
    let params = $(e.target).find(`button`).attr(`data-params`);
    data.uploadData($(e.target)[0],params);
});
//DELETE IMAGE
$(document).on('click','.deleteImage', function ()  {
    let elem = $(this).parent('.store_img');
    data.deleteImage(elem);
});
//DELETE PRODUCT
$(document).on('click','.delete', function ()  {
    let url = $(this).attr('data-action');
        data.deleteProduct(url);
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
