
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function () {

        $("#button").click(
            function () {

            $("input[name='hidden_date").attr('value', $("input[name='date']").val());
            $("input[name='hidden_text").attr('value', $("input[name='text']").val());


   			$("div").html($("#form_hidden").serialize());

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





