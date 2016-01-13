<article>
    <h2>Znajdź Zdjęcia</h2>

    <input type="text" id="search_photos" class="form-input" placeholder="Wyszukaj..."/>

    <div class="photos"></div>
</article>

<script>
    $(function() {
        $("#search_photos").on('keyup', function(event) {
            $.ajax({
                url: "/index.php/ajax/searchPhoto/" + $("#search_photos").val()
            }).done(function(data) {
                $(".photos").html(data);
            });
        });
    });
</script>