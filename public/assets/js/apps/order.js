$(function () {
  const nextPageButton = document.querySelector(".next-page-order-button");

  const dataTable = () => {
    $(`#table`).DataTable({
      ajax: {
        url: `${CORE.baseUrl}/app/orders/get`,
        data: function (d) {
          return {
            ...d,
            page: d.start / d.length + 1,
          };
        },
      },
      processing: true,
      serverSide: true,
      initComplete: () => {
        const checkboxes = document.querySelectorAll(".order-checkbox");

        checkboxes.forEach((checkbox) => {
          checkbox.addEventListener("click", function (e) {
            const { checked, value } = e.target;

            if (checked) {
              const vendor = nextPageButton.dataset.vendor;

              if (vendor) {
                nextPageButton.dataset.href = `${CORE.baseUrl}/vendor/orders/${value}`;
              } else {
                nextPageButton.dataset.href = `${CORE.baseUrl}/app/orders/${value}`;
              }
            }
          });
        });
      },
    });
  };

  dataTable();

  nextPageButton.addEventListener("click", function (e) {
    e.preventDefault();
    const href = e.target.dataset.href;

    if (!href) {
      return Swal.fire({
        icon: "info",
        title: "Choose order first",
        timer: 1000,
        showConfirmButton: false,
        toast: true,
        position: "bottom-right",
      });
    }

    document.location = href;
  });

  window.addEventListener("refresh-datatable", (event) => {
    const allOrder = event.detail.all_order;

    dataTable();
  });
});
