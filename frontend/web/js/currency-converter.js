document.addEventListener('DOMContentLoaded', function(){
    var convertors = document.getElementsByClassName("currency-convertor");

    for (var i = 0; i < convertors.length; i++) {
        var cur_convertor = convertors[i];

        var convertor_item_inputs = cur_convertor.querySelectorAll('.list-group-item .form-control');
        var convertor_item_main_input = cur_convertor.querySelector('.list-group-item .form-control.main');

        for (var j = 0; j < convertor_item_inputs.length; j++) {
            var convertor_item_input = convertor_item_inputs[j];

            convertor_item_input.addEventListener("input", (event) => {
                var cur_input = event.target;

                cur_input.value = cur_input.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');

                // remove classes
                var elList  = cur_convertor.querySelectorAll('.list-group-item .form-control');
                elList.forEach(el => el.classList.remove("is-valid"));

                // add new active element
                cur_input.classList.add("is-valid");

                // update main element price
                if (!cur_input.isEqualNode(convertor_item_main_input)) {
                    convertor_item_main_input.value = (cur_input.getAttribute('v_unit_rate') * cur_input.value).toFixed(4);
                }

                // update other elements price
                for (var k = 0; k < convertor_item_inputs.length; k++) {
                    var convertor_item_input_change_price = convertor_item_inputs[k];

                    if (!convertor_item_input_change_price.isEqualNode(convertor_item_main_input) && !convertor_item_input_change_price.isEqualNode(cur_input)) {
                        convertor_item_input_change_price.value = (convertor_item_main_input.value / convertor_item_input_change_price.getAttribute('v_unit_rate')).toFixed(4);
                    }
                }
            });
        }
    }
});