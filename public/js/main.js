class Data {
    constructor() {
        this.files = [];
        this.iterator = 0;
        this.tableImage = [];
    }

    conditions() {
        //REQUEST ICON
        let requestCount = $(`.notice`);
        if (!requestCount.text()) requestCount.addClass(`d-none`);

        //FRIENDS REQUEST BUTTON TEXT
        let requestButton = $(`.request`),
            length = requestButton.length;
        if (length !== 0) {
            for (let i = 0; i < length; i++) {
                if (requestButton.eq(i).text() === `Sent`) requestButton.eq(i).removeAttr('data-action').attr(`disabled`, true);
            }
        }
    }

    readFile(files) {
        if (files) {
            $.each(files, (key, value) => {
                this.files.push(value);
                let reader = new FileReader();
                reader.onload = function () {
                    data.showImage(reader.result);
                };
                reader.readAsDataURL(value);
            });
        }
    }

    uploadData(form, params) {
        let formData = new FormData(form);

        let images = data.files.filter((el) => el);
        formData.delete('file[]');

        $.each(images, (key, val) => {
            formData.append('file[]', val);
        });

        $.each(data.tableImage, (key, image) => {
            formData.append('base_img[]', image);
        });


        $.ajax({
            url: params,
            data: formData,
            type: 'post',
            success: (_data) => {
                if (_data) {
                    _data = JSON.parse(_data);
                    if (_data['error']) {
                        this.generateError(_data['error']);
                        return false;
                    } else if (_data['warning']) {
                        toastr.warning(_data['warning']);
                        return false;
                    } else if (_data['message']) {
                        toastr.info(_data['message']);
                        return true;
                    } else if (_data['link'])  window.location.href = `http://mvc.loc/${_data['link']}`;
                }
            },
            contentType: false,
            processData: false,
        });

    }

    showImage(img) {
        let imgBlock = `<div class="store_img d-inline-block mb-5"  data-id="${this.iterator++}">
                            <a role="button" class="deleteImage"><i class="fas fa-times"></i></a>
                            <img src="${img}" alt="Product Photo"> 
                        </div>`;
        $(`.file`).after(imgBlock);
    }

    generateError(errors) {
        toastr.error('Fix Errors');
        $.each(errors, (field, error) => {
            let errorBlock = `<span class="text-danger small errorBlock">${error}</span>`;
            $(`#${field}`).after(errorBlock);
        });
    }

    deleteImage(elem) {
        let elemId = elem.attr('data-id'),
            images = this.files,
            _tableImage = elem.closest(`.store_img`).attr(`data-name`);

        if (_tableImage) {
            this.tableImage.push(_tableImage);
        } else delete images[elemId];

        elem.remove();
        if (!images.filter((el) => el).length) $(`[type=file]`).val('');
    }

    deleteProduct(url) {
        let cond = confirm("Do you want to delete this product?");

        if (cond) {
            $.ajax({
                url: url,
                async: false,
                success: (data) => {
                    data = JSON.parse(data);
                    window.location.href = `http://mvc.loc/${data['link']}`;
                },
                error: (err) => {
                    console.error(err);
                }
            });
        }
    }

    request(url, elem) {
        $.ajax({
            url: url,
            method: "post",
            success: (_data) => {
                if (!_data) return false;
                _data = JSON.parse(_data);
                if (_data['message']) toastr.success(_data['message']);
                if (_data['delete']) {
                    elem = elem.closest(`.${_data['delete']}`);
                    elem.remove();
                }
            },
            error: (err) => {
                console.error(err);
            }
        });
    }

}

let data = new Data();
data.conditions();
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
    if($(e.target).find(`.btn`).hasClass(`register`)) $(e.target).find(`.btn`).attr(`disabled`,true);
    let errorBlock = $(`.errorBlock`);
    if(errorBlock) errorBlock.remove();
    let params = $(e.target).find(`button`).attr(`data-params`);
    data.uploadData($(e.target)[0],params,e);
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
//FRIENDS REQUEST
$(document).on('click','.request',(e) => {
    let elem  = $(e.target),
        action = elem.attr('data-action');
    elem.attr('disabled',true);
    data.request(action,elem);
});




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
