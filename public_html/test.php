<html>
    <head>
    <?php require_once('includes/header.inc.php');?>
    </head>
    <body>
        <form role="form">
            <div id="load"></div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control"
                id="input-email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label
                    for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control"
                id="input-password"
                placeholder="Password">
            </div>
           <button id="submit-button" type="submit" class="btn btn-default">Submit</button> 
        </form>
    </body>
    <?php require_once('includes/footer.inc.php');?>
<script>
$('#submit-button').click( function(event) {
    event.preventDefault(); 
    var password = $('#input-password').val();
    var email = $('#input-email').val();
    $('#load').load('home.php');
});
</script>
</html>
