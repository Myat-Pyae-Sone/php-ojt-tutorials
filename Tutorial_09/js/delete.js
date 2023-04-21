$(document).ready(function()
{
    $('.delete-btn').on('click',function()
    {
        var id = $(this).data('id');
        if(confirm("Are you sure you want to delete this post?"))
        {
            window.location.href='delete.php?deleteid='+id;
        }
    });
});