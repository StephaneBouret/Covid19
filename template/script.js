$(document).ready(function(){

	$("#searchBar").dropdown({
        maxSelections: 1
	});
	$("#btnSearch").on("click", function()
    {
        $.post(
            "search.php",
            {search: $("#searchBar").val()},
            function(data)
            {
                $("#list").html("");
                $("#list").append(data);
            });
    });

    $(function(){
		function _confirm()
		{
			return (confirm('Voulez-vous supprimer l\'adhérent ?'));
		}
		$('#closeMember').click(_confirm);
    });

//show password
    $('.icon-eye-hide').on('click', function () {

        $(this).toggleClass('icon-eye');
        let password = $("[name=password]");
        if (password.attr('type') === "password") {
            password.attr('type', 'text');
        } else {
            password.attr('type', 'password');
        }
    });


});