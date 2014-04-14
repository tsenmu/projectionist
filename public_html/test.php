<script src="js/jquery.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
    <div class="input-append date form_datetime">
    <input size="16" type="text" value="" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
     
    <script type="text/javascript">
    $(".form_datetime").datetimepicker({
    format: "dd MM yyyy - hh:ii"
    });
    </script> 
