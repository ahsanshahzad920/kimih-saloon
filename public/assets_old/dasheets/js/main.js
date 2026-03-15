(function ($) {
    "use strict";


    // $(document).ready(function () {
    //     // Event delegation for plus button
    //     $(document).on("click", ".qty-plus-btn", function () {
    //         var input = $(this).siblings(".qty-input");
    //         input.val(parseInt(input.val()) + 1);
    //     });

    //     // Event delegation for minus button
    //     $(document).on("click", ".qty-minus-btn", function () {
    //         var input = $(this).siblings(".qty-input");
    //         var currentValue = parseInt(input.val());
    //         if (currentValue > 1) {
    //             input.val(currentValue - 1);
    //         }
    //     });
    // });

    // Quantity button
    // $(document).ready(function () {
    //     $("#plusBtn").click(function () {
    //         $("#quantityInput").val(parseInt($("#quantityInput").val()) + 1);
    //     });

    //     $("#minusBtn").click(function () {
    //         var currentValue = parseInt($("#quantityInput").val());
    //         if (currentValue > 1) {
    //             $("#quantityInput").val(currentValue - 1);
    //         }
    //     });
    // });
    // Quantity Button end








    function removeBarcodeFun(){
        const removeButtons = document.querySelectorAll(".removeBarcodeBtn");

        removeButtons.forEach(button => {
            button.addEventListener("click", function() {
                const row = button.closest('.barcodeRow');
                if (row) {
                    row.remove();
                }

            });
        });
    }



    // Create Product on Click Create Barcode section
    var barcodeCount = 1; // Initialize barcode count

    // Function to create the barcode section
    function createBarcodeSection() {
        barcodeCount++;
        var barcodeContainer = document.createElement('div');
        barcodeContainer.classList.add('row', 'border-bottom', 'mt-2','barcodeRow');
        barcodeContainer.id = 'barcode' + barcodeCount;

        var col1 = document.createElement('div');
        col1.classList.add('col-md-5');

        var formGroup = document.createElement('div');
        formGroup.classList.add('form-group');

        var label1 = document.createElement('label');
        label1.textContent = 'Barcode Symbology *';
        label1.htmlFor = 'barcodeSymbology' + barcodeCount;

        var select = document.createElement('select');
        select.classList.add('form-control', 'form-select', 'subheading', 'mt-1');
        select.setAttribute('aria-label', 'Default select example');
        select.id = 'barcodeSymbology' + barcodeCount;
        select.name = 'barcodeSymbology' + barcodeCount;

        var option1 = document.createElement('option');
        option1.value = 'Code 128';
        option1.textContent = 'Code 128';
        var option2 = document.createElement('option');
        option2.value = 'Code 39';
        option2.textContent = 'Code 39';
        var option3 = document.createElement('option');
        option3.value = 'EAN8';
        option3.textContent = 'EAN8';
        var option4 = document.createElement('option');
        option4.value = 'EAN13';
        option4.textContent = 'EAN13';
        var option5 = document.createElement('option');
        option5.value = 'UPC';
        option5.textContent = 'UPC';

        select.appendChild(option1);
        select.appendChild(option2);
        select.appendChild(option3);
        select.appendChild(option4);
        select.appendChild(option5);

        formGroup.appendChild(label1);
        formGroup.appendChild(select);

        col1.appendChild(formGroup);

        var col2 = document.createElement('div');
        col2.classList.add('col-md-5');

        var label2 = document.createElement('label');
        label2.textContent = 'Product Code';
        label2.htmlFor = 'productCode' + barcodeCount;

        var inputGroup = document.createElement('div');
        inputGroup.classList.add('input-group', 'mt-1', 'subheading');

        var input = document.createElement('input');
        input.type = 'text';
        input.classList.add('form-control', 'subheading');
        input.placeholder = 'Barcode';
        input.setAttribute('aria-label', "Recipient's username");
        input.setAttribute('aria-describedby', 'basic-addon2');
        input.id = 'productCode' + barcodeCount;
        input.name = 'productCode' + barcodeCount;

        var span = document.createElement('span');
        span.classList.add('input-group-text', 'subheading');
        span.id = 'basic-addon2' + barcodeCount;

        var icon = document.createElement('i');
        icon.classList.add('bi', 'bi-upc-scan');

        span.appendChild(icon);
        inputGroup.appendChild(input);
        inputGroup.appendChild(span);

        var paragraph = document.createElement('p');
        paragraph.textContent = 'Scan the barcode or symbology';

        col2.appendChild(label2);
        col2.appendChild(inputGroup);
        col2.appendChild(paragraph);

        var col3 = document.createElement('div');
        col3.classList.add('col-md-2', 'pt-1');

        var div = document.createElement('div');
        var button = document.createElement('button');
        button.classList.add('btn', 'text-danger', 'border-danger', 'w-100', 'subheading', 'mt-4','delete-barcode');
        var icon = document.createElement('i');
        icon.classList.add('bi', 'bi-trash3');

        button.appendChild(icon);
        div.appendChild(button);
        col3.appendChild(div);

        barcodeContainer.appendChild(col1);
        barcodeContainer.appendChild(col2);
        barcodeContainer.appendChild(col3);

        // Insert new barcode fields before the existing section with "Add another barcode" paragraph
        document.getElementById('barcodeSection').insertBefore(barcodeContainer, document.getElementById('barcodeButtonSection'));
    }

    // Add event listener to the "Add another barcode" paragraph
    document.getElementById('addBarcode').addEventListener('click', function () {
        createBarcodeSection();
        document.getElementById('barcodeCount').innerHTML = barcodeCount;
        removeBarcodeFun();
    });
    // delete-barcode
    // Add event listener to the "Delete Barcode" button
    $(document).on("click", ".delete-barcode", function () {
        document.getElementById('barcodeCount').innerHTML = (barcodeCount - 1);
        barcodeCount = (barcodeCount - 1);
        var barcode = $(this).closest('.row');
        barcode.remove();
    });
    removeBarcodeFun()

})(jQuery);
