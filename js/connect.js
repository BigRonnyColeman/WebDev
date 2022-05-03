function connect(){
    loadScript('//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');

    // Post request with the given email and hashedPassword
    $.ajax({

        type: "POST",
        url: "../php/connect.php" ,
        data: {},

        success : function( response ) {
            //alert(response);
        }
    });
}

// Generic script load script
function loadScript(url)
{
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;
    head.appendChild(script);
}