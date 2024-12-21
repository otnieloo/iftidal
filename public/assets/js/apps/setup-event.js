let event_name = document.querySelector(`[name="event_name"]`);
let event_type_id = document.querySelector(`[name="event_type_id"]`);
let event_date = document.querySelector(`[name="event_date"]`);
let event_start_time = document.querySelector(`[name="event_start_time"]`);
let event_end_time = document.querySelector(`[name="event_end_time"]`);
let location_id = document.querySelector(`[name="location_id"]`);
let event_guest_count = document.querySelector(`[name="event_guest_count"]`);
let event_start_budget = document.querySelector(`[name="event_start_budget"]`);
let event_end_budget = document.querySelector(`[name="event_end_budget"]`);
let vendor_range = document.querySelector(`[name="vendor_range"]`);
let latitude = document.querySelector(`#latitudeUser`);
let longitude = document.querySelector(`#longitudeUser`);

const Order = {
  orderID: 0,
  allowLocation: false,

  next() {
    $("#smartwizard").smartWizard("next");
  },

  async storeStep1() {
    if (Order.allowLocation) {
      let payload = {
        event_name: event_name.value,
        event_type_id: event_type_id.value,
        event_date: event_date.value,
        event_start_time: event_start_time.value,
        event_end_time: event_end_time.value,
        location_id: location_id.value,
        event_guest_count: event_guest_count.value,
        event_start_budget: event_start_budget.value,
        event_end_budget: event_end_budget.value,
        vendor_range: vendor_range.value,
        latitude: latitude.value,
        longitude: longitude.value,
        order_id: Order.orderID,
      };

      document.querySelector(`#sectionValidationError`).classList.add("d-none");
      const request = await fetch(`/user/events/step1`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "X-CSRF-TOKEN": CORE.csrfToken,
        },
        body: JSON.stringify(payload),
      });

      switch (request.status) {
        case 200:
          let responseSuccess = await request.json();
          Order.orderID = responseSuccess.data.id;
          $("#smartwizard").smartWizard("next");
          break;
        case 400:
          const response = await request.json();
          CORE.sweet("error", "Fails!", response.message);
          Order.inserValidationError(response.data);
          break;
        default:
          CORE.sweet("error", "Fails!", "Something went wrong!");
          break;
      }
    } else {
      CORE.sweet("error", "Fails!", "You must allow the location!");
    }
  },

  inserValidationError(dataErrors) {
    const listInput = document.querySelectorAll(".form-control");
    // console.log(listInput);
    const listNameError = Object.keys(dataErrors);

    listInput.forEach((input) => {
      let validationID = "";
      if (input.hasAttribute("data-validation-id")) {
        validationID = input.getAttribute("data-validation-id");
      }
      let inputName = input.name;
      let findInput = listNameError.find(
        (d) => d == inputName || d == validationID
      );

      // console.log(findInput);
      if (findInput) {
        input.classList.add("is-invalid");
        input.nextElementSibling.innerHTML = `<small class="text-danger">${dataErrors[findInput][0]}</small>`;
      } else {
        input.nextElementSibling.innerHTML = ``;
        input.classList.remove("is-invalid");
      }
    });
  },

  changeCategory(index) {
    const navsCategories = document.querySelectorAll(".list-group-category");
    const navsSubCategories = document.querySelectorAll(".list-sub-categories");

    navsCategories.forEach((nav) => {
      nav.classList.remove("active");
    });
    navsSubCategories.forEach((nav) => {
      nav.classList.add("d-none");
    });

    navsCategories[index].classList.add("active");
    navsSubCategories[index].classList.remove("d-none");
  },

  async storeStep2(next = true) {
    let subCategoryIds = [];
    const listCheckbox = document.querySelectorAll(
      ".input-checkbox-subcategories"
    );

    listCheckbox.forEach((checkbox) => {
      if (checkbox.checked) {
        subCategoryIds.push(checkbox.value);
      }
    });

    if (subCategoryIds.length > 0) {
      const payload = {
        order_id: Order.orderID,
        vendor_category_ids: subCategoryIds,
      };

      const request = await fetch(`/user/events/step2`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "X-CSRF-TOKEN": CORE.csrfToken,
        },
        body: JSON.stringify(payload),
      });

      switch (request.status) {
        case 200:
          let responseSuccess = await request.json();
          Order.drawOrder(
            responseSuccess.data.order,
            responseSuccess.data.categories
          );
          if (next) {
            $("#smartwizard").smartWizard("next");
          }
          break;
        case 400:
          const response = await request.json();
          CORE.sweet("error", "Fails!", response.message);
          break;
        default:
          CORE.sweet("error", "Fails!", "Something went wrong!");
          break;
      }
    } else {
      CORE.sweet("error", "Fails!", "Please select at least one category!");
    }
  },

  drawOrder(order, categories) {
    document.querySelector("#textEventName").innerHTML = order.event_name;
    document.querySelector("#textEventType").innerHTML = order.event_type;
    document.querySelector("#textEventPeriod").innerHTML =
      dayjs(order.event_date + " " + order.event_start_time).format("hh A") +
      " - " +
      dayjs(order.event_date + " " + order.event_end_time).format("hh A");
    document.querySelector("#textEventDate").innerHTML = dayjs(
      order.event_date
    ).format("MMMM DD YYYY");
    document.querySelector("#textSetLocation").innerHTML = order.location;
    document.querySelector("#textEstGuest").innerHTML = order.event_guest_count;
    document.querySelector(
      "#textRangeBudget"
    ).innerHTML = `RM. ${order.event_start_budget} - RM. ${order.event_end_budget}`;

    let template = document.querySelector("#rowOrderCategories");
    let html = "";

    categories.forEach((category) => {
      html += `<div class="row">
                <div class="col-lg-2 col-md-12 text-end text-muted">${category.vendor_category}</div>
                <div class="col-lg-8 col-md-12 event-summary">`;
      category.subs.forEach((sub) => {
        html += `<div class="badges">${sub.vendor_category}</div>`;
      });
      html += `</div>`;
      html += `</div>`;
    });

    template.innerHTML = html;
  },

  async nextStep3(next = true) {
    if (document.querySelector("#modalFilter").classList.contains("show")) {
      CORE.closeModal("modalFilter");
    }

    const inputsFilter = document.querySelectorAll(".input-filter-vendor");
    let queryString = "";
    let delimiter = "";

    inputsFilter.forEach((input) => {
      queryString += delimiter + input.name + "=" + input.value;
      delimiter = "&";
    });

    const request = await fetch(`/user/events/step4?${queryString}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
      body: JSON.stringify({
        order_id: Order.orderID,
      }),
    });

    if (request.status == 200) {
      const response = await request.json();

      this.drawVendorSearch(response.data);

      if (next) {
        $("#smartwizard").smartWizard("next");
      }
    } else if (request.status == 404) {
      CORE.sweet("error", "Fails!", "Vendor not found!");
    } else {
      CORE.sweet("error", "Fails!", "Something error!");
    }
  },

  drawVendorSearch(data) {
    let headerTab = "";
    let bodyTab = "";
    const vendorSearchContainer = document.getElementById(
      "vendorsearchcontainer"
    );

    data.forEach((d, index) => {
      const categoryName = d.vendor_category.split(" ")[0].toLowerCase();
      const parentCategory = d.parent_category.vendor_category;
      const category = d.vendor_category;

      headerTab += `<li style="max-width: 110%;" class="nav-item text-center">
            <a class="nav-link ${
              index == 0 ? "active" : ""
            } w-100" id="tab-${categoryName}" data-bs-toggle="tab" href="#${categoryName}" role="tab"
              aria-controls="home" aria-selected="true">${d.vendor_category}</a>
          </li>`;

      const vendors = d.vendors;

      bodyTab += `<div class="tab-pane fade ${
        index == 0 ? "show active" : ""
      } p-0" id="${categoryName}" role="tabpanel" aria-labelledby="home-${categoryName}">`;

      vendors.forEach((vendor) => {
        bodyTab += `<div class="row vendor-search my-3" onClick="Product.openModalDetailVendor(${vendor.vendor_id})">
              <div class="col-lg-6 col-md-12 d-flex" style="gap:1rem;">

                <span class="avatar avatar-xxl brround cover-image"
                  style="background: url('${vendor.logo}') center center;">
                  <span class="avatar-icons bg-blue"><i class="fe fe-check fs-12"></i></span>
                </span>

                <div>
                  <h3 class="fw-bold" style="margin-bottom: 0;">${vendor.vendor_name}</h3>
                  <div class="text-muted">${parentCategory} : ${category}</div>
                  <div class="text-muted">Location: English</div>
                </div>
              </div>

              <div class="col-lg-6 col-md-12 d-flex justify-content-between">
                <div class="text-center">
                  <i class="fe fe-check"></i>
                  <div class="text-muted">Listing</div>
                  <div class="text-secondary fs-4 fw-bold">25</div>
                </div>

                <div class="text-center">
                  <i class="fe fe-star"></i>
                  <div class="text-muted">Level</div>
                  <div class="text-secondary fs-4 fw-bold">25</div>
                </div>

                <div class="text-center">
                  <i class="fe fe-star"></i>
                  <div class="text-muted">Ratings</div>
                  <div class="text-secondary fs-4 fw-bold">25</div>
                </div>

                <div class="text-center">
                  <i class="fe fe-star"></i>
                  <div class="text-muted">Matched</div>
                  <div class="text-secondary fs-4 fw-bold">25</div>
                </div>
              </div>

            </div>`;
      });

      bodyTab += `</div>`;
    });

    const element = `
      <div class="col-lg-2 col-md-12">
        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
          ${headerTab}
        </ul>
      </div>
      <div class="col-lg-10 col-md-12">
        <div class="tab-content border p-3" id="myTab3Content">
        ${bodyTab}
        </div>
      </div>`;

    vendorSearchContainer.innerHTML = element;
  },

  async nextStep4() {
    try {
      const request = await fetch("/user/events/listorder");
      const status = request.status;

      if (status === 200) {
        const response = await request.json();
        const { data } = response;

        Product.drawCart(data);
      }
    } catch (error) {
      console.log(error);
      Swal.fire({
        icon: "error",
        title: "Internal Server Error",
        text: "Please try again later",
        showConfirmButton: false,
        timer: 1000,
      });
    }
  },

  initGetLongLat() {
    const latitudeInput = document.getElementById("latitudeUser");
    const longitudeInput = document.getElementById("longitudeUser");

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          // Ambil latitude dan longitude
          const lat = position.coords.latitude;
          const long = position.coords.longitude;

          // Simpan di input field
          latitudeInput.value = lat;
          longitudeInput.value = long;
          Order.allowLocation = true;
        },
        (error) => {
          console.error("Error getting location:", error.message);
          alert("Gagal mengambil lokasi. Pastikan izin lokasi diaktifkan!");
        }
      );
    } else {
      alert("Geolocation tidak didukung di browser Anda!");
    }
  },

  async initTransaction() {
    try {
      const request = await fetch(`/user/events/checkevent`, {
        method: "GET",
        headers: {
          Accept: "application/json",
        },
      });

      const status = request.status;
      const response = await request.json();

      if (status === 200) {
        // Do all here

        if (response.data.length) {
          let { data } = response;
          data = data[0];

          Order.orderID = data.id;

          event_name.value = data.event_name;
          event_type_id.value = data.event_type_id;
          event_date.value = data.event_date;
          event_start_time.value = removeSecond(data.event_start_time);
          event_end_time.value = removeSecond(data.event_end_time);
          location_id.value = data.location_id;
          event_start_budget.value = data.event_start_budget;
          event_end_budget.value = data.event_end_budget;
          vendor_range.value = data.vendor_range;

          removeSecond(data.event_start_time);

          $("#event_number_guest").val(data.event_guest_count);
          $("#event_number_guest").trigger("change");

          if (data.order_vendor_category.length) {
            const listCriteria = document.querySelectorAll(
              ".input-checkbox-subcategories"
            );

            listCriteria.forEach((checkbox) => {
              const criteriaId = checkbox.value;

              const selected = data.order_vendor_category.filter(
                (c) => c.vendor_category_id == criteriaId
              );

              if (selected.length) {
                checkbox.checked = true;
              }
            });

            Order.storeStep2(false);
            Order.nextStep3(false);
            Order.nextStep4();
          }
        }
      }
    } catch (e) {
      console.log(e);
      // Error handling here
      alert("failed connect to server");
    }
  },

  checkout() {
    const buttonCheckout = document.getElementById("button-checkout");

    buttonCheckout.addEventListener("click", async function () {
      buttonCheckout.innerHTML = "Loading";

      try {
        const inputCheckeds = document.querySelectorAll("[name='item_id[]']");
        let items = "";
        let delimiter = "";

        inputCheckeds.forEach((input) => {
          if (input.checked) {
            items += delimiter + input.value;
            delimiter = ",";
          }
        });

        const request = await fetch("/user/events/checkout", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": CORE.csrfToken,
          },
          body: JSON.stringify({
            items: items,
          }),
        });
        const status = request.status;

        if (status === 200) {
          const response = await request.json();
          const { data } = response;

          const form = document.createElement("form");
          form.method = "POST";
          form.action =
            "https://uatpaymenthub.infinpay.com/api/pymt/pw/v1.1/payment";
          document.body.appendChild(form);

          const input = document.createElement("input");
          input.type = "hidden";
          input.name = "jwt";
          input.value = data.jwt;
          form.appendChild(input);

          form.submit();
        } else {
          CORE.showToast("error", "Internal server error");
        }
      } catch (e) {
        CORE.showToast("error", "Internal server error");
      }
    });
  },
};

const Product = {
  products: [],

  openModalDetailVendor: async (vendorId) => {
    //Fetch product by vendor id
    const request = await fetch(`/user/products?vendor_id=${vendorId}`, {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    });

    const response = await request.json();

    const status = request.status;

    if (status === 200) {
      const data = response.data;

      const { company_name: companyName, logo } = data;

      const products = data.product;
      Product.products = products;

      const companyNameElement = document.querySelectorAll(
        ".vendor-modal-company-name"
      );

      companyNameElement.forEach((element) => {
        element.innerHTML = companyName;
      });

      let element = "";
      products.forEach((data) => {
        const images = data.product_images;
        let listElementImages = ``;

        if (images.length) {
          images.forEach((image) => {
            listElementImages += `<div class="item">
            <div class="card custom-card overflow-hidden mb-0 ">
                <a href="#">
                <img src="${image.product_image}" class="w-100" style="height:70px;" alt="img"></a>
            </div>
          </div>`;
          });
        }

        element += `<div class="col-lg-3 product-cart" data-id="${data.id}">
        <div>
            <div class="card custom-card overflow-hidden">
                <div>
                    <a href="javascript:void(0)">
                      <img src="${
                        data.product_image
                      }" alt="img" class="cover-image br-7 w-100" style="height:230px;">
                    </a>
                </div>
            </div>
            <div class="card">
                  <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                        ${listElementImages}
                  </div>
            </div>
        </div>
      
        <div class="text-center">
            <h6 class="fw-bold">${data.product_name}</h6>
            <div>${data.product_description}</div>
            <select name="event_type_id" id="event_type_id" class="form-control form-select default-select">
                <option value="0">Select Type Of Event</option>
            </select>
      
        </div>
      
        <div class="d-flex mt-3 justify-content-between">
            <div>
                <div class="fw-bold">${data.product_sell_price}</div>
                <div style="width: 100px;">per unit</div>
            </div>
      
            <div class="d-flex align-items-center justify-content-end">
                <div class="qty-button" no-update-cart="true">-</div>
                <input type="number" class="form-control qty-input" no-update-cart="true" 
                data-max="${data.product_stock || 0}">
                <div class="qty-button" no-update-cart="true">+</div>
            </div>
        </div>
      
      
        <div class="d-flex mt-3 justify-content-between">
            <div class="fw-bold">Total</div>
            <div class="total-price-cart">RM 0</div>
        </div>
      
        <div class="d-flex" style="gap:.5rem;">
            <button class="btn btn-gray button-detail-product"
                style="width: 100%;">Detail</button>
            <button class="btn btn-info add-to-cart-button" style="width: 100%;">Add to cart</button>
        </div>
      </div>`;
      });

      const productContainer = document.getElementById("product-container");

      productContainer.innerHTML = "";
      productContainer.innerHTML = element;

      Product.initImageProduct();
      Product.initProduct();

      CORE.showModal("modalDetailVendor");
    }
  },

  initImageProduct: () => {
    var owl = $(".owl-carousel-icons2");
    owl.owlCarousel({
      loop: true,
      rewind: false,
      margin: 25,
      animateIn: "fadeInDowm",
      animateOut: "fadeOutDown",
      autoplay: false,
      autoplayTimeout: 5000, // set value to change speed
      autoplayHoverPause: true,
      dots: false,
      nav: true,
      autoplay: true,
      responsiveClass: true,
      responsive: {
        0: {
          items: 2,
          nav: true,
        },
        600: {
          items: 2,
          nav: true,
        },
        1300: {
          items: 4,
          nav: true,
        },
      },
    });
  },

  initProduct: () => {
    const qtyCarts = document.querySelectorAll(".qty-input");

    qtyCarts.forEach((qty) => {
      const minusButton = qty.previousElementSibling;
      const plusButton = qty.nextElementSibling;
      let max = qty?.dataset?.max || 0;
      let productCart = qty.closest(".product-cart");
      let productId = productCart ? productCart.dataset.id : qty.dataset?.id;
      let type = qty.dataset.type || "product";
      let isDetailProduct = qty.getAttribute("detail-product") || 0;
      isDetailProduct = parseInt(isDetailProduct);

      let addToCartButton = null;
      let totalElement = null;
      let detailButton = null;
      if (qty.parentElement.parentElement.nextElementSibling) {
        totalElement =
          qty.parentElement.parentElement.nextElementSibling.querySelector(
            ".total-price-cart"
          );
        addToCartButton =
          qty.parentElement.parentElement.nextElementSibling.nextElementSibling.querySelector(
            ".add-to-cart-button"
          );

        detailButton =
          qty.parentElement.parentElement.nextElementSibling.nextElementSibling.querySelector(
            ".button-detail-product"
          );
      }

      if (isDetailProduct) {
        addToCartButton =
          qty.parentElement.parentElement.parentElement.parentElement.nextElementSibling.querySelector(
            ".add-to-cart-button"
          );

        console.log(addToCartButton);
      }

      const product = Product.products.find((pro) => pro.id == productId);

      qty.addEventListener("keyup", function () {
        let value = parseInt(qty.value || 0);

        if (value < 0) value = 0;

        if (value > parseInt(max)) {
          value = max;
        }

        let getAttributeUpdateCart = this.getAttribute("no-update-cart");

        if (!getAttributeUpdateCart) {
          Product.updateCart(value, productId, type);
        }

        qty.value = value;

        if (totalElement) {
          updateTotalElement(value);
        }
      });

      minusButton.addEventListener("click", function (e) {
        let value = parseInt(qty.value || 0);

        if (value <= 0) return;

        value -= 1;

        let getAttributeUpdateCart = this.getAttribute("no-update-cart");
        if (!getAttributeUpdateCart) {
          Product.updateCart(value, productId, type);
        }

        qty.value = value;

        if (totalElement) {
          updateTotalElement(value);
        }
      });

      plusButton.addEventListener("click", function (e) {
        let value = parseInt(qty.value || 0);

        console.log(isDetailProduct);

        if (value >= parseInt(max)) {
          return;
        }

        value += 1;

        let getAttributeUpdateCart = this.getAttribute("no-update-cart");
        if (!getAttributeUpdateCart) {
          Product.updateCart(value, productId, type);
        }

        qty.value = value;

        if (totalElement) {
          updateTotalElement(value);
        }
      });

      if (addToCartButton) {
        addToCartButton.addEventListener("click", async function (e) {
          let value = parseInt(qty.value || 0);

          if (value <= 0) {
            Swal.fire({
              icon: "warning",
              title: "Please input qty first",
              toast: true,
              showConfirmButton: false,
              time: 1000,
              position: "bottom-right",
            });

            return;
          }

          // Send Data To Server
          Product.updateCart(qty.value, productId, type);
        });
      }

      const updateTotalElement = (value) => {
        totalProduct = Product.calculateTotal(product, value);
        totalElement.innerHTML = CORE.formatToMYR(totalProduct);
      };

      if (detailButton) {
        detailButton.addEventListener("click", function (e) {
          const productImages = product.product_images;
          let productImagesElement = "";
          if (productImages) {
            productImages.forEach((image) => {
              productImagesElement += `<div class="item">
              <div class="card custom-card overflow-hidden mb-0">
                <img src="${image.product_image}" class="w-100" style="height:70px;" alt="img">
              </div>
            </div>`;
            });
          }

          const detailProductElement = `<div class="col-lg-3 col-md-12 px-5">
        <div class="card custom-card overflow-hidden">
          <div>
            <a href="javascript:void(0)">
            <img src="${product.product_image}" alt="img"
                class="cover-image br-7 w-100" style="height:230px;">
                </a>
          </div>
        </div>
        <div class="card">
          <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
            ${productImagesElement}
          </div>
        </div>
      </div>

      <div class="col-lg-9 col-md-12">
        <h3 class="fw-bold">${product.product_name}</h3>
        <div class="product-gallery-rats d-flex">
          <ul class="product-gallery-rating">
            <li>
              <a href="javascript:void(0);"><i class="fa fa-star text-warning"></i></a>
              <a href="javascript:void(0);"><i class="fa fa-star text-warning"></i></a>
              <a href="javascript:void(0);"><i class="fa fa-star text-warning"></i></a>
              <a href="javascript:void(0);"><i class="fa fa-star text-warning"></i></a>
            </li>
          </ul>
          <div class="label-rating ms-2 d-flex gap-2">
            <div class="text-secondary">79</div>
            <div>|</div>
            <div>
              <span class="fw-bold">45</span>
              <span class="text-muted">Ratings</span>
            </div>
          </div>
        </div>

        <div>
          <h3 class="text-secondary fw-bold mt-3">RM 150 - RM 250</h3>
        </div>

        <div class="form-group mt-4">
          <div class="row">
            <div class="col-lg-2 col-md-12">
              <label class="form-label" for="event_type_id">Variation</label>
            </div>
            <div class="col-lg-3 col-md-12">
              <select name="event_type_id" id="event_type_id" class="form-control form-select default-select">
                <option value="0">Select Type Of Event</option>
                <option value="blue">Red</option>
                <option value="red">Blue</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group mt-4">
          <div class="row">
            <div class="col-lg-2 col-md-12">
              <label class="form-label" for="event_type_id">Quantity</label>
            </div>
            <div class="col-lg-3 col-md-12">
              <div class="d-flex align-items-center justify-content-start">
                <div class="qty-button" no-update-cart="true">-</div>
                <input type="number" class="form-control qty-input" no-update-cart="true" 
                data-max="${product.product_stock || 0}" 
                data-id="${product.id}" detail-product="1">
                <div class="qty-button" no-update-cart="true">+</div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex" style="gap:.5rem;">
          <button class="btn btn-gray">Later</button>
          <button class="btn btn-info add-to-cart-button">Add to cart</button>
        </div>
      </div>`;

          const productDescription = document.querySelector(
            ".product-description"
          );

          productDescription.innerHTML = "";
          productDescription.innerHTML = product.product_description;

          const detailProductContainer = document.querySelector(
            ".product-detail-container"
          );

          detailProductContainer.innerHTML = "";
          detailProductContainer.innerHTML = detailProductElement;

          CORE.showModal("modalDetailProduct");

          Product.initImageProduct();
          Product.initProduct();
        });
      }
    });
  },

  updateCart: CORE.debounce(async (qty, productId, type) => {
    const request = await fetch(`/user/events/addtocart`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
      body: JSON.stringify({
        qty,
        product_id: productId,
        type,
      }),
    });

    const status = request.status;

    if (status === 200) {
      CORE.showToast("success", "Product has ben added to cart");
      Product.calculateTotalCart();
    }
  }, 350),

  calculateTotal(product, value) {
    let totalProduct = parseInt(product.product_sell_price) * value;
    const productPackage = product.product_package;

    if (productPackage && value >= productPackage.minimum_qty) {
      let valuePackage = parseInt(productPackage.value);

      if (product.product_package.package_type == 1) {
        let discount = totalProduct * (valuePackage / 100);
        totalProduct -= discount;
      } else if (product.product_package.package_type == 2) {
        let discount = valuePackage;
        totalProduct -= discount;
      } else {
        totalProduct = valuePackage * value;
      }
    }

    return totalProduct;
  },

  getPrice(value) {
    return value.replace("RM&nbsp;", "").replace(".00", "");
  },

  calculateTotalCart() {
    const checkedItems = document.querySelectorAll(".item-product-cart");
    const rowGrandTotal = document.querySelectorAll(
      ".grand-total-each-product"
    );
    let index = 0;
    let grandTotal = 0;
    let totalProduct = 0;

    checkedItems.forEach((item) => {
      if (item.checked) {
        totalProduct++;
        grandTotal += parseInt(
          Product.getPrice(rowGrandTotal[index].innerHTML)
        );
        // console.log(Product.getPrice(rowGrandTotal[index].innerHTML));
      }
      index++;
    });

    document.querySelector("#totalProductCart").innerHTML = totalProduct;
    document.querySelector("#grandTotal").innerHTML =
      CORE.formatToMYR(grandTotal);
  },

  drawCart(datas) {
    const cartContainer = document.getElementById("cartContainer");

    let element = ``;
    let totalDiscount = 0;
    let countProduct = 0;
    let grandTotal = 0;

    // console.log(datas);

    for (const data in datas) {
      countProduct++;

      const d = datas[data];
      const products = d.products;
      const companyName = d.company_name;
      totalDiscount = d.total_discount;
      grandTotal = d.grand_total;
      let productElement = ``;
      products.forEach((product) => {
        Product.products.push(product);

        const stock = product.product_stock || 0;

        productElement += `<tr>
              <td class="text-center" style="width: 5%;">
                <input type="checkbox" class="item-product-cart" name="item_id[]" value="${
                  product.item_id
                }" onclick="Product.calculateTotalCart()" checked>
              </td>
              <td style="width: 25%;">
                <div class="d-flex gap-3 align-items-center">
                  <img src="${product.image}"
                    class="avatar avatar-xxl br-7" alt="person-image">
                  <div>${product.product_name}</div>
                </div>
              </td>
              <td class="text-center" style="width: 10%;">Variaton A</td>
              <td class="text-center" style="width: 15%;">
                <div>
                  ${CORE.formatToMYR(product.product_sell_price)}
                </div>
              </td>
              <td class="text-center" style="width: 25%;">
                <div class="d-flex align-items-center justify-content-center">
                  <div class="qty-button">-</div>
                  <input type="text" class="form-control qty-input" 
                  value="${product.qty}" 
                  data-max="${stock}" 
                  data-id="${product.id}" data-type="cart">
                  <div class="qty-button">+</div>
                </div>
              </td>
              <td class="text-center" style="width: 15%;">
                <div>
                  <span class="total-price-cart grand-total-each-product">
                  ${CORE.formatToMYR(product.grand_total)}
                  </span>
                </div>
              </td>
              <td class="text-center">
                <i class="fa-solid fa-trash" 
                onClick="Product.removeProductFromCart(${
                  d.order_product_id
                })"></i>
              </td>
            </tr>`;
      });

      element += `<div class="card">
      <div class="card-body cart-body">
        <div class="table-responsive">
          <table class="table text-nowrap text-md-nowrap mb-0">
            <thead>
              <tr style="background-color:#E6E6E6;">
                <th class="text-center">
                  <input type="checkbox">
                </th>
                <th colspan="6">
                  <div class="fw-bold">${companyName}</div>
                </th>
              </tr>
            </thead>
            <tbody>
              ${productElement}
            </tbody>
          </table>
        </div>
      </div>
    </div>`;
    }

    document.getElementById("totalDiscount").innerHTML =
      CORE.formatToMYR(totalDiscount);
    document.getElementById("grandTotal").innerHTML =
      CORE.formatToMYR(grandTotal);

    cartContainer.innerHTML = "";
    cartContainer.innerHTML = element;

    Product.initProduct();
    Product.calculateTotalCart();
  },

  removeProductFromCart(orderProductId) {
    CORE.promptUser("Delete product from cart?", async () => {
      const request = await fetch(`/user/events/${orderProductId}`, {
        method: "DELETE",
        headers: {
          "X-CSRF-TOKEN": CORE.csrfToken,
        },
        body: JSON.stringify({
          _method: "DELETE",
        }),
      });

      const status = request.status;

      if (status == 200) {
        CORE.sweet("success", "Success!", "Product deleted!");
        Order.nextStep4();
      } else {
        CORE.sweet("error", "Fails!", "Failed to delete product!");
      }
    });
  },
};

function removeSecond(date) {
  if (date == "") return;
  const d = date.split(":");

  return d[0] + ":" + d[1];
}

document.addEventListener("DOMContentLoaded", function () {
  Order.initGetLongLat();
  Order.initTransaction();
  Order.checkout();
});
