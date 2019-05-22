<div class="d-flex flex-row justify-content-center align-items-stretch">
    <!-- Search container -->
    <div class="d-flex flex-grow-1">

        <select id="search-box" class="select2-search form-control-lg" name="states[]" lang="[lang=" da"]"
        multiple="multiple">


		<?php

        $all_names = get_all_taxonomy_names();

		foreach ( $all_names as $value ): ?>

            <option value="<?php echo $value ?>"><?php echo $value ?></option>
		<?php endforeach; ?>

        </select>
    </div>
    <div class="pull-left d-flex">
        <button class="btn" id="search-btn" type="submit">Søg</button>
    </div>

</div>


<script>
    $(document).ready(function () {
        $('.select2-search').select2({
            language: "da"
        });


        $('select').on(
            'select2:select', (
                function () {
                    $('search-box').focus(); //TODO: Find a way to redo focus on box
                }
            )
        );

        $('#search-btn').click(function () {

            let valuearray = $('#search-box').val();
            forEach()

        });

    });
</script>
