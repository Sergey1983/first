
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function () {

        $("#button").click(
            function () {

            $("input[name='hidden_date']").val($("input[name='date']").val());
            $("input[name='hidden_text']").val($("input[name='text']").val());


   			$("div").append('<br>', 'form_hidden.serialize(): ', $("#form_hidden").serialize(), '<br>','hidden_date.val() = ', $("[name='hidden_date']").val(), ' hidden_text.val() = ', $("[name='hidden_text']").val(), '<br><br>' );

            }            
        );
    });




</script>

<form id="form_hidden" hidden = "hidden">

	<input type="date" name="hidden_date"/>
	<input type="text" name="hidden_text"/>

</form>

<form id="form">

        <input type="date" name="date"/> <label>date</label><br><br>
        <input type="text" name="text"/> <label>text</label>

</form>


<button id="button">print hidden.serialize()</button><br><br>
<a href="http://www.google.com">link to google.com</a>
<br>
<br>
<div></div>





