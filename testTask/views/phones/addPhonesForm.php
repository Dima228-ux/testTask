<style type="text/css">

    #ss, .del_variant{

        cursor: pointer;

    }



</style>
<script>

    $(document)

        .ready(function () {

            var variant = $('#uzz')

                .clone(true);

            $('#ss')

                .click(function () {

                    $(variant)

                        .clone(true)

                        .appendTo('#variants')

                        .fadeIn('slow')

                        .find("input[name*=name]")

                        .focus();

                });

            $(document)

                .on('click', 'a.del_variant', function () {

                    $(this)

                        .parents(".control-group")

                        .remove();

                });

        });
    $(function() {

        $("#phone").mask("+7 (999) 999-99-99");

    });
</script>
<body>
<form method="post" action="/phones/addPhones" >
<div id="variants">

        <div class="control-group" id="uzz"  >

            <div class="controls">

                <div><label>Phone:<input type="tel" name="phones[]"  required placeholder="+7 (___) ___-__-__" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$" minlength="12" /><a class="del_variant" >X</a></label></div>

            </div>

        </div>
</div><span id="ss">Добавить вариант</span>
<div><input style="color: cadetblue" type="submit" value="Add phones"></div>
</body>
</form>
