<nav>
    <div>
        <a href="../screens/players.php"><img src=../assets/Apoal_logo.png width="10%" height="..." alt="logo_apoal" />
        </a>
    </div>
</nav>

<script>
$(function() {
    $('.btn').each(function() {
        if ($(this).prop('href') == window.location.href) {
            $(this).addClass('active');
            $(this).parents('li').addClass('active');
        }
    });
});
</script>