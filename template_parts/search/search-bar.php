<div class="d-flex flex-row justify-content-center align-items-stretch">
    <!-- Search container -->

    <!--<form method="get" id="searchform" action="/">-->

        <div class="d-flex flex-grow-1 search-container">

            <select id="search-box" class="select2-search form-control-lg" name="s" lang="[lang=" da"]"
            multiple="multiple">


			<?php

			$all_names = get_all_taxonomy_names();

			foreach ( $all_names as $value ): ?>

                <option url="rgange=" value="<?php echo $value ?>"><?php echo $value ?></option>
			<?php endforeach; ?>

            </select>
        </div>
        <div class="pull-left d-flex">
            <button class="btn" id="search-btn" type="submit">Søg</button>
        </div>
        <!-- <input type="hidden" name="term_name" value="term_name">
        <input type="hidden"  name="taxonomy"  value="taxonomy">-->
        <input type="hidden" class="field" name="s" value="" id="s" placeholder="Search">

<!--    </form> -->
</div>


<script>
    $(document).ready(function () {
        $('.select2-search').select2({
            language: "da",

        });

        $('select').on(
            'select2:select', (
                function () {
                    //$('#search-box').focus(); //Keeps
                    $('#search-box').select2('open'); // Keeps select box open

                }
            )
        );

        $('#search-btn').click(function () {

            let values = $('#search-box').find(':selected');

            for(let value of values){
                console.log(value);
                value.attr(url);
            }

        });

    });
</script>
