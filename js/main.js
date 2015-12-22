
/**
 * Helper for vanilla get by id
 * @param selector
 * @returns {HTMLElement}
 */
function $id(selector) {
    return document.getElementById(selector);
}

/**
 * Helper for vanilla get by class
 *
 * @param selector
 * @returns {NodeList}
 */
function $class(selector) {
    return document.getElementsByClassName(selector);
}

/**
 * Performs an ajax request using XMLHttpRequest
 *
 * @param options must contain:
 * url: string
 * type: string
 * clear: function (called on success)
 * formData: a FormData Object
 */
function ajax(options) {
    var req = new XMLHttpRequest();
    //Append time string to url to remove ajax cache
    req.open(options.type, options.url + '?' + new Date().getTime(), true);
    req.onload = function() {
        if(req.status === 201 || req.status === 200) {
            options.complete();
            console.log("success");
            location.reload(true);
        } else {
            alert('Error occured!');
        }
    };
    req.send(options.formData);
}


document.addEventListener("DOMContentLoaded", function(event) {
    $id('content-overview').style.display = 'block';
    $id('content-add-new').style.display = 'none';

    $id('add-new').onclick = function() {
        $id('content-overview').style.display = 'none';
        $id('content-add-new').style.display = 'block';
    };
    $id('overview').onclick = function() {
        $id('content-overview').style.display = 'block';
        $id('content-add-new').style.display = 'none';
    };

    $id('add-form').onsubmit = function(e) {
        e.preventDefault();
        //Get the data from inputs and alike
        var formData = new FormData();
        formData.append('movie-title', $id('movie-title').value);
        formData.append('movie-desc', $id('movie-desc').value);
        formData.append('movie-rating', $id('movie-rating').value);

        //Append the file
        var file = $id('poster').files[0];
        formData.append('poster',file,file.name);
        formData.append('submit',1);

        ajax({
            url: 'ajax.php',
            type: 'POST',
            complete: function() {
                $id('movie-title').value = '';
                $id('movie-desc').value = '';
                $id('movie-rating').selectedIndex = 0;
            },
            formData: formData
        });
    };

    //Append "remove movie"-function to every row in the table
    var obj = $class('remove');
    for (var i = 0; i < obj.length; i++){
        obj[i].onclick = function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('id',e.target.id);
            formData.append('remove', 1);
            console.log(e.target.id);
            ajax({
                url: 'ajax.php',
                type: 'POST',
                complete: function() {
                    console.log('update table')
                },
                formData: formData
            });
        }
    }



});



