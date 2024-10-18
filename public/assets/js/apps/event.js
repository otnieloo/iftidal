$(function () {
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

  $(".next").click(function (e) {
    const button = $(this);

    let validation = false;
    if (button.length) {
      const parentElement = button[0].parentElement.parentElement;
      const inputs = parentElement.getElementsByTagName("input");
      // validation = validate(inputs);
    }

    $("#smartwizard").smartWizard("next");
  });

  $(".prev").click(function (e) {
    $("#smartwizard").smartWizard("prev");
  });
});

flatpickr("#date", {
  altInput: true,
  altFormat: "F j, Y",
  dateFormat: "Y-m-d",
});

//For Time Picker
flatpickr(".timepikcr", {
  enableTime: true,
  noCalendar: true,
  dateFormat: "H:i",
});

// $(".treeview").treed();

// ========================================================================================= CUSTOM ==========================================================

const listCheckboxCriteria = document.querySelectorAll(".criteria-control");

if (listCheckboxCriteria.length) {
  for (const checkboxCriteria of listCheckboxCriteria) {
    checkboxCriteria.addEventListener("change", function (e) {
      const checkboxParent = e.target.parentElement.parentElement.parentElement;

      const selectedCheckbox = checkboxParent.querySelectorAll(
        "input[type=checkbox]:checked"
      );

      const container = checkboxParent.parentElement.parentElement;

      if (selectedCheckbox.length > 0) {
        if (!container.classList.contains("criteria-selected")) {
          container.classList.add("criteria-selected");
        }
      } else {
        console.log("Kesini");
        if (container.classList.contains("criteria-selected")) {
          container.classList.remove("criteria-selected");
        }
      }
    });
  }
}

const vendorSearch = document.querySelectorAll(".vendor-search");
const buttonDetailProduct = document.querySelectorAll(".button-detail-product");

let modalDetailVendor = new bootstrap.Modal(
  document.getElementById("modalDetailVendor"),
  {
    keyboard: false,
  }
);

let modalDetailProduct = new bootstrap.Modal(
  document.getElementById("modalDetailProduct"),
  {
    keyboard: false,
  }
);

if (vendorSearch.length) {
  for (const vendor of vendorSearch) {
    vendor.addEventListener("click", function (e) {
      modalDetailVendor.show();
    });
  }
}

if (buttonDetailProduct.length) {
  for (const buttonDetail of buttonDetailProduct) {
    buttonDetail.addEventListener("click", async function (e) {
      await modalDetailVendor.hide();
      modalDetailProduct.show();
    });
  }
}

const buttonModalDetailVendor = document.querySelector(
  ".btn-action-modal-close"
);

const buttonModalDetailProduct = document.querySelector(
  ".btn-action-modal-product-close"
);

if (buttonModalDetailVendor) {
  buttonModalDetailVendor.addEventListener("click", function (e) {
    modalDetailVendor.hide();
  });
}

if (buttonModalDetailProduct) {
  buttonModalDetailProduct.addEventListener("click", function (e) {
    modalDetailProduct.hide();
    modalDetailVendor.show();
  });
}

const qtyCart = document.querySelectorAll(".qty-input");

if (qtyCart.length) {
  for (const qty of qtyCart) {
    const minusButton = qty.previousElementSibling;
    const plusButton = qty.nextElementSibling;
    let max = qty?.dataset?.max || 10;

    minusButton.addEventListener("click", function (e) {
      let value = parseInt(qty.value || 0);

      if (value !== parseInt(1)) {
        qty.value = value - 1;
      }
    });

    plusButton.addEventListener("click", function (e) {
      let value = parseInt(qty.value || 0);

      if (value !== parseInt(max)) {
        qty.value = value + 1;
      }
    });

    qty.addEventListener("change", function (e) {});
  }
}
