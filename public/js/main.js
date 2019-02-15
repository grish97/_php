let image = {
    imageArray : [],

    read : (files) => {
        $.each(files, (key, value) => {
            let reader = new FileReader();
                image.imageArray.push(reader.result);
                image.viewImage(reader,value);

        });
    },

    viewImage : (reader,file) =>  {
        reader.onload = function() {
            image.imageArray.push(reader.result);
        };

        reader.readAsDataURL(file);
        console.log(image.imageArray);
    }
};

let fileInput = document.getElementById('file');
fileInput.addEventListener('change', function (event) {
    image.read(event.target.files);
});

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
