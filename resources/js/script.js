import $ from 'jquery';

import select2 from "select2"
select2(); 

$('#submitButton').on('click', function(e) {
    e.preventDefault();
    const form = $('#submitForm').get(0);
    const submitButton = $('#submitButton');
    const spinner = submitButton.find(".spinner-border");

    if (form.checkValidity()) {
      // Disable submit button
      submitButton.prop('disabled', true);
      submitButton.addClass("disabled");

      // Remove d-none class from spinner if it exists
      if (spinner.length) {
          spinner.removeClass("d-none");
      }

      // Submit form
      form.submit();
    } else {
        // If the form is not valid, trigger HTML5 validation messages
        form.reportValidity();
    }
});

// Add event listener to the document for delegating click events
$(document).on('click', '.delete-button', function (event) {
    event.preventDefault();
    
    const formId = $(this).data('form-id');
    const submitButton = $(this);
    const spinner = submitButton.find(".spinner-border");
    const icon = submitButton.find('.fa-trash-can');

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3e60d5",
        cancelButtonColor: "#f15776",
        confirmButtonText: "Yes, delete it!",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            submitButton.prop("disabled", true);
            submitButton.addClass("disabled");
            if (spinner.length) {
                icon.hide();
                spinner.removeClass("d-none");
            }
            document.getElementById(formId).submit();
        }
    });
});

$('.form-select').select2({
    theme: "bootstrap-5",
});
