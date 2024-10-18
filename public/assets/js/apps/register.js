$(function () {
  // SmartWizard initialize

  $("#smartwizard").smartWizard({
    selected: 0,
    theme: "dots",
    justified: true, // Nav menu justification. true/false
    autoAdjustHeight: true, // Automatically adjust content height
    toolbar: {
      position: "bottom", // none|top|bottom|both
      showNextButton: false, // show/hide a Next button
      showPreviousButton: false, // show/hide a Previous button
    },
    transition: {
      animation: "fade", // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
      speed: "400", // Animation speed. Not used if animation is 'css'
    },
  });

  $("#smartwizard").smartWizard("reset");

  $(".next").click(function (e) {
    const button = $(this);

    let validation = false;

    if (button.length) {
      const parentElement = button[0].parentElement.parentElement;
      const inputs = parentElement.getElementsByTagName("input");
      validation = validate(inputs);
    }

    if (validation) {
      $("#smartwizard").smartWizard("next");
    }
  });

  $(".prev").click(function (e) {
    $("#smartwizard").smartWizard("prev");
  });
});

function validate(inputs) {
  if (inputs.length) {
    for (const input of inputs) {
      if (input.type === "checkbox") {
        if (!input.checked) {
          if (!input.classList.contains("is-invalid")) {
            input.classList.add("is-invalid");
          }

          return false;
        }
      }

      if (input.value === "") {
        if (!input.classList.contains("is-invalid")) {
          input.classList.add("is-invalid");
        }

        return false;
      }

      if (input.classList.contains("is-invalid")) {
        input.classList.remove("is-invalid");
      }

      if (input.id === "name") {
        $("#vendor_name").val(input.value);
      }
    }

    return true;
  }

  return false;
}
