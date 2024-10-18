const Order = {
  orderId: 1,

  setOrderId(orderId) {
    Order.orderId = orderId;
  },

  async addToCart(id, detail = false) {
    let qty = parseInt(document.querySelector(`#inputQty${id}`).value);
    if (detail) {
      qty = parseInt(document.querySelector(`#inputQtyDetail${id}`).value);
    }

    if (qty > 0) {
      const payload = {
        order_id: Order.orderId,
        product_id: id,
        qty: qty,
      };

      const request = await fetch(`/user/events/cart`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "X-CSRF-TOKEN": CORE.csrfToken,
        },
        body: JSON.stringify(payload),
      });

      // console.log(await request.json());
      if (request.status == 200) {
        CORE.sweet("success", "Success!", "Product added to cart successfully!");
      } else if (request.status == 403) {
        const response = await request.json();
        CORE.sweet("error", "Fails!", response.message);
      } else {
        CORE.sweet("error", "Fails!", "Something went wrong, please try again!");
      }
    } else {
      CORE.sweet("error", "Fails!", "You must enter a valid quantity!");
    }
  },

  step5InitOrder() {
    Livewire.on("step5-success-get-order", function() {
      $("#smartwizard").smartWizard("next");
    });
    Livewire.on("step5-success-checkout", function() {
      CORE.sweet("success", "Success!", "Order created successfully!");

      setTimeout(() => {
        window.location = `/user/events`;
      }, 2000);
    });
    Livewire.on("step5-fails-checkout", function(message) {
      CORE.sweet("error", "Fails!", message);
    });
  },

  step4InitOrder() {
    Livewire.emit("step4_set_order", Order.orderId);
    Livewire.on("step4-success-get-vendor", function() {
      Order.initImageProduct();
      Order.initCartQty();
      CORE.showModal("modalDetailVendor");
    });

    Livewire.on("step4-success-get-product", function() {
      CORE.closeModal("modalDetailVendor");
      CORE.showModal("modalDetailProduct");
      Order.initCartQty();
    });
  },

  closeModalProduct() {
    CORE.closeModal("modalDetailProduct");
    CORE.showModal("modalDetailVendor");
  },

  initImageProduct() {
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

  changeImageProduct(url, id) {
    document.querySelector(`#${id}`).src = url;
  },

  initCartQty() {
    const products = JSON.parse(document.querySelector("#listDataProduct").value);
    const qtyCart = document.querySelectorAll(".qty-input");

    if (qtyCart.length) {
      for (const qty of qtyCart) {
        const minusButton = qty.previousElementSibling;
        const plusButton = qty.nextElementSibling;
        let max = qty?.dataset?.max || 10;
        let id = qty.getAttribute("data-id");

        qty.addEventListener("keyup", function() {
          const product = products.find(pro => pro.id == id);

          if (parseInt(qty.value) > max) {
            qty.value = max;
          }

          const totalQty = parseInt(qty.value);
          let totalProduct = parseInt(product.price) * totalQty;

          // console.log(product);
          if (product.package && totalQty > parseInt(product.package.minimum_qty)) {
            let valuePackage = parseInt(product.package.value);

            if (product.package.package_type == 1) {
              let discount = totalProduct * (valuePackage / 100);
              totalProduct -= discount;
            } else if (product.package.package_type == 2) {
              let discount = valuePackage;
              totalProduct -= discount;
            } else {
              totalProduct = valuePackage * totalQty;
            }
          }

          document.querySelector(`#totalPriceProduct${id}`).innerHTML = totalProduct;
        });

        minusButton.addEventListener("click", function (e) {
          let value = parseInt(qty.value || 0);
          // console.log(product);

          if (value !== parseInt(1)) {
            qty.value = value - 1;
          }

          const product = products.find(pro => pro.id == id);
          let totalQty = parseInt(qty.value);
          let totalProduct = parseInt(product.price) * totalQty;

          if (product.package && totalQty > product.package.minimum_qty) {
            let valuePackage = parseInt(product.package.value);

            if (product.package.package_type == 1) {
              let discount = totalProduct * (valuePackage / 100);
              totalProduct -= discount;
            } else if (product.package.package_type == 2) {
              let discount = valuePackage;
              totalProduct -= discount;
            } else {
              totalProduct = valuePackage * totalQty;
            }
          }

          document.querySelector(`#totalPriceProduct${id}`).innerHTML = totalProduct;
        });

        plusButton.addEventListener("click", function (e) {
          let value = parseInt(qty.value || 0);

          if (value !== parseInt(max)) {
            qty.value = value + 1;
          }

          const product = products.find(pro => pro.id == id);
          let totalQty = parseInt(qty.value);
          let totalProduct = parseInt(product.price) * totalQty;

          if (product.package && totalQty > product.package.minimum_qty) {
            let valuePackage = parseInt(product.package.value);

            if (product.package.package_type == 1) {
              let discount = totalProduct * (valuePackage / 100);
              totalProduct -= discount;
            } else if (product.package.package_type == 2) {
              let discount = valuePackage;
              totalProduct -= discount;
            } else {
              totalProduct = valuePackage * totalQty;
            }
          }

          document.querySelector(`#totalPriceProduct${id}`).innerHTML = totalProduct;
        });

        qty.addEventListener("change", function (e) {});
      }
    }
  },

  step3InitOrder() {
    Livewire.emit("step3_set_order", Order.orderId);
    Livewire.on("step3-success-get-data", function() {
      $("#smartwizard").smartWizard("next");
      Order.drawListCategory();
    });
  },

  initStep2Success() {
    Livewire.on("step2-success", function () {
      Order.step3InitOrder();
      Order.step4InitOrder();
    });
  },

  next2() {
    const checkboxs = document.querySelectorAll(".checkbox-category");
    let category_ids = [];

    checkboxs.forEach((ch) => {
      if (ch.checked) {
        category_ids.push(ch.value);
      }
    });

    if (category_ids.length > 0) {
      Livewire.emit("save", category_ids);
    } else {
      CORE.sweet("error", "Your must choice minimal 1 category!");
    }
  },

  next3() {
    $("#smartwizard").smartWizard("next");
  },

  next4() {
    Livewire.emit("step5_set_order", Order.orderId);
    Order.step5InitOrder();
  },

  drawListCategory() {
    const template = document.querySelector("#listCategoryEvent");
    let html = "";
    let categories = JSON.parse(
      document.querySelector("#InputListCategory").value
    );
    let categoryIds = JSON.parse(
      document.querySelector("#InputCategoryIds").value
    );

    // console.log(categoryIds);
    categories.forEach((category) => {
      html += `<div class="col-lg-4">`;
      html += `<ul class="treeview ">`;
      html += `<li>`;

      html += `<a href="javascript:void(0);">`;
      html += `${category.vendor_category}`;
      html += `</a>`;

      html += `<ul>`;
      category.subs.forEach((sub) => {
        let checked = categoryIds.find((d) => d == sub.id) ? "checked" : "";

        html += `<li>
                  <div class="d-flex align-items-center">
                    <input type="checkbox" class="criteria-control checkbox-category" value="${sub.id}" ${checked}>
                    <label for="" style="margin-top:10px;">${sub.vendor_category}</label>
                  </div>
                </li>`;
      });
      html += `</ul>`;

      html += `</li>`;
      html += `</ul>`;
      html += `</div>`;
    });

    template.innerHTML = html;
    $(".treeview").treed();
  },

  step2InitOrder() {
    Order.initStep2Success();

    Livewire.emit("step2_set_order", Order.orderId);
    Livewire.on("step2-draw-category", function () {
      Order.drawListCategory();
    });
  },

  initStep1Success() {
    Livewire.on("step1-success", function (orderId) {
      Order.setOrderId(orderId);
      $("#smartwizard").smartWizard("next");

      Order.step2InitOrder();
    });
  },

  init() {
    Order.initStep1Success();
  },
};

Order.init();
